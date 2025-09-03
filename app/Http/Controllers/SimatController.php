<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Simat;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use NumberFormatter;
use NumberToWords\NumberToWords;

class SimatController extends Controller
{
    public function index(Request $request)
    {
        $query = Simat::query();

        if (!auth()->user()->hasRole('Super Admin')) {
            $query->where('user_id', auth()->id());
        }


        if ($request->filled('today') && $request->today == '1') {
            $query->whereDate('created_at', Carbon::today());
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $fromDate = Carbon::parse($request->from_date)->startOfDay(),
                $toDate = Carbon::parse($request->to_date)->endOfDay()
            ]);
        } else {
            $fromDate = Carbon::today()->startOfDay();
            $toDate = Carbon::today()->endOfDay();
        }

        $query->whereBetween('created_at', [$fromDate, $toDate]);

        $simats = $query->orderBy('created_at', 'desc')->get();


        return view('pages.simats.index', compact('simats', 'fromDate', 'toDate'));
    }


    public function create(): View
    {
        $nationalities = Nationality::pluck('name', 'id');
        $fees = \App\Models\Fee::all(); // جلب كل الرسوم

        return view('pages.simats.create', compact('nationalities', 'fees'));
    }


    public function numberToWords($number)
    {
        $formatter = new \NumberFormatter("ar", \NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }


    public function printReceipt($id)
    {
        $simat = Simat::findOrFail($id);

        $total = $simat->fee_number + $simat->labor_fee;
        $totalInWords = $this->numberToWords($total);

        return view('pages.simats.receipt', compact('simat', 'total', 'totalInWords'));
    }



    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'birth_date' => 'nullable|string|max:255',
                'passport_number' => 'required|string|max:255',
                'visa_type' => 'required|string|max:255',
                'country_code' => 'nullable|string',
                'labor_fee' => 'nullable|numeric',
                'nationality' => 'nullable|string',
            ]);

            $nationality = Nationality::findOrFail($data['nationality']);
            $fee = Fee::findOrFail($request->fee_id);
            $duration = $fee->duration;

            $existingRecords = Simat::where('passport_number', $request->passport_number)->get();


            foreach ($existingRecords as $existing) {
                if ($existing->validity_duration === '6 أشهر') {
                    $createdDate = Carbon::parse($existing->created_at);
                    $now = Carbon::now();

                    $daysPassed = $createdDate->diffInDays($now);
                    $daysRequired = 182;
                    $daysRemaining = $daysRequired - $daysPassed;

                    if ($daysPassed < $daysRequired) {
                        return back()->withInput()->with('error', 'هذا الجواز مسجل مسبقاً وهو من فئة 6 أشهر يجب الانتظار حتى انتهاء المدة لتجديده');
                    }
                }
            }

            $data['entry_date'] = now();

            switch ($duration) {
                case '15 يوم':
                    $data['country_code'] = 9;
                    break;
                case 'شهر':
                    $data['country_code'] = 28;
                    break;
                case '3 أشهر':
                    $data['country_code'] = 14;
                    break;
                case '6 أشهر':
                    $data['country_code'] = 10;
                    break;
                case 'مجاني':
                    $data['country_code'] = 45;
                    break;
                default:
                    $data['country_code'] = null;
                    break;
            }

            $data['fee_number'] = $fee->amount;
            $data['validity_duration'] = $duration;
            $data['fee_text'] = $fee->amount;
            $data['nationality'] = $nationality->name;
            $data['user_id'] = auth()->id();

            $simat = Simat::create($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'id' => $simat->id,
                    'message' => 'تمت الإضافة بنجاح'
                ]);
            }

            return redirect()->route('simats.create')->with('print_id', $simat->id);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()
                ]);
            }
            return back()->withInput()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage());
        }
    }




    public function show(Simat $simat): View
    {
        $simat->load('nationality');
        return view('pages.simats.show', compact('simat'));
    }

    public function edit($id): View
    {
        $simat = Simat::findOrFail($id);
        $nationalities = Nationality::pluck('name', 'id');
        $fees = \App\Models\Fee::all(); // جلب كل الرسوم

        return view('pages.simats.edit', compact('nationalities', 'fees', 'simat'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $simat = Simat::findOrFail($id);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'birth_date' => 'nullable|string|max:255',
                'passport_number' => 'required|string|max:255',
                'visa_type' => 'required|string|max:255',
                'country_code' => 'nullable|string',
                'labor_fee' => 'nullable|numeric',
                'nationality' => 'nullable|string',
                'fee_id' => 'required|exists:fees,id',
            ]);

            $fee = Fee::findOrFail($data['fee_id']);
            $duration = $fee->duration;

            switch ($duration) {
                case '15 يوم':
                    $data['country_code'] = 9;
                    break;
                case 'شهر':
                    $data['country_code'] = 28;
                    break;
                case '3 أشهر':
                    $data['country_code'] = 14;
                    break;
                case '6 أشهر':
                    $data['country_code'] = 10;
                    break;
                case 'مجاني':
                    $data['country_code'] = 45;
                    break;
                default:
                    $data['country_code'] = null;
                    break;
            }

            $nationality = Nationality::find($request->input('selected_nationality_id'));
            if ($nationality) {
                $data['nationality'] = $nationality->name;
            }

            $data['fee_number'] = $fee->amount;
            $data['validity_duration'] = $fee->duration;
            $data['fee_text'] = $fee->amount;

            $simat->update($data);

            return redirect()->route('simats.index')->with('success', 'تم التحديث بنجاح');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }



    public function destroy($id): RedirectResponse
    {
        try {
            $simat = Simat::findOrFail($id);
            $deletedSerial = (int) $simat->serial_number;

            $simat->delete();

            Simat::whereNotNull('serial_number')
                ->where('serial_number', '>', $deletedSerial)
                ->decrement('serial_number');

            return to_route('simats.index')->with('success', 'تم الحذف بنجاح');

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
        }
    }
}
