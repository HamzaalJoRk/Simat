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

class SimatController extends Controller
{


    public function index(Request $request)
    {
        $query = Simat::query();

        // فلترة حسب تاريخ اليوم فقط
        if ($request->filled('today') && $request->today == '1') {
            $query->whereDate('created_at', Carbon::today());
        }

        // فلترة بين تاريخين
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->from_date)->startOfDay(),
                Carbon::parse($request->to_date)->endOfDay()
            ]);
        }

        $simats = $query->get();

        return view('pages.simats.index', compact('simats'));
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



    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'birth_date' => 'nullable|string|max:255',
                'passport_number' => 'required|string|max:255|unique:simats',
                'entry_date' => 'required|string',
                'visa_type' => 'required|string|max:255',
                'country_code' => 'nullable|string',
                'labor_fee' => 'nullable|numeric',
                'nationality' => 'nullable|string',
            ]);

            $fee = Fee::findOrFail($request->fee_id);

            $data['fee_number'] = $fee->amount;
            $data['validity_duration'] = $fee->duration;
            $data['fee_text'] = $fee->amount;

            Simat::create($data);

            return to_route('simats.index')->with('success', 'تمت الإضافة بنجاح');
        } catch (\Exception $e) {
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
                'passport_number' => 'required|string|max:255|unique:simats,passport_number,' . $simat->id,
                'entry_date' => 'required|string',
                'visa_type' => 'required|string|max:255',
                'country_code' => 'nullable|string',
                'labor_fee' => 'nullable|numeric',
                'nationality' => 'nullable|string',
                'fee_id' => 'required|exists:fees,id',
                'fee_number' => 'required|numeric',
                'fee_text' => 'required|string',
                'validity_duration' => 'nullable|string',
            ]);

            // جلب بيانات الرسوم المختارة لتحديث بعض الحقول تلقائياً إذا أردت
            $fee = \App\Models\Fee::findOrFail($data['fee_id']);
            $data['fee_number'] = $fee->amount;          // يمكن تحديث الرقم بناء على الرسوم
            $data['validity_duration'] = $fee->duration; // يمكن تحديث مدة الصلاحية بناء على الرسوم

            $simat->update($data);

            return redirect()->route('simats.index')->with('success', 'تم التحديث بنجاح');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }


    public function destroy(Simat $simat): RedirectResponse
    {
        $simat->delete();
        return to_route('simats.index')->with('success', 'تم الحذف بنجاح');
    }
}
