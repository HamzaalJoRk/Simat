<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Carbon\Carbon;


class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        $query = Insurance::query();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
        } else {
            $fromDate = Carbon::today()->startOfDay();
            $toDate = Carbon::today()->endOfDay();
        }

        // فلترة بين التاريخين
        $query->whereBetween('created_at', [$fromDate, $toDate]);

        $insurances = $query->orderBy('created_at', 'desc')->get();

        return view('pages.insurances.index', compact('insurances', 'fromDate', 'toDate'));

    }


    public function printReceipt($id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('pages.insurances.receipt', compact('insurance'));
    }


    public function create()
    {
        return view('pages.insurances.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|string',
                'vehicle_type' => 'required|string',
                'model' => 'required|string',
                'chassis_number' => 'required|string',
                'plate_number' => 'required|string',
                'start_date' => 'required|date',
                'duration' => 'required', // تأكد أن النوع رقمي
                'amount_numeric' => 'required',
                'notes' => 'nullable|string',
            ]);

            // حساب تاريخ النهاية تلقائياً
            $startDate = Carbon::parse($request->start_date);
            $endDate = $startDate->copy()->addDays($request->duration);

            // إنشاء التأمين مع تعديل end_date
            $insurance = Insurance::create([
                'name' => $request->name,
                'vehicle_type' => $request->vehicle_type,
                'model' => $request->model,
                'chassis_number' => $request->chassis_number,
                'plate_number' => $request->plate_number,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'duration' => $request->duration,
                'amount_numeric' => $request->amount_numeric,
                'amount_written' => $request->amount_numeric,
                'notes' => $request->notes,
            ]);

            return redirect()->route('insurances.create')->with('print_id', $insurance->id);
        } catch (\Exception $e) {
            // في حالة حدوث أي خطأ
            return redirect()->back()->withInput()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }



    public function show($id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('pages.insurances.show', compact('insurance'));
    }

    public function edit($id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('pages.insurances.edit', compact('insurance'));
    }

    public function update(Request $request, $id)
    {
        $insurance = Insurance::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'chassis_number' => 'required|string',
            'plate_number' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'duration' => 'required|string',
            'fee_number' => 'required|numeric',
            'fee_text' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $insurance->update($request->all());
        return redirect()->route('insurances.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy($id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();
        return redirect()->route('insurances.index')->with('success', 'تم الحذف بنجاح');
    }
}
