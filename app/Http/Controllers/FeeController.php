<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeeController extends Controller
{
    public function index(): View
    {
        $fees = Fee::with('nationality')->latest()->get();
        return view('pages.fees.index', compact('fees'));
    }

    public function create(): View
    {
        $nationalities = Nationality::all();
        // dd($nationalities);
        return view('pages.fees.create', compact('nationalities'));
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $data = $request->validate([
            'nationality_id' => 'required|exists:nationalities,id',
            'type' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'entry_count' => 'required|integer',
            'amount' => 'required',
        ]);

        Fee::create($data);

        return to_route('nationalities.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(Fee $fee): View
    {
        $fee->load('nationality');
        return view('pages.fees.show', compact('fee'));
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $nationalities = Nationality::all();

        return view('pages.fees.edit', compact('fee', 'nationalities'));
    }


    public function update(Request $request, $id): RedirectResponse
    {

        // dd($request->all());
        $data = $request->validate([
            'nationality_id' => 'exists:nationalities,id',
            'type' => 'required|string|max:255',
            'duration' => 'string|max:255',
            'entry_count' => 'integer',
            'amount' => 'numeric',
        ]);

        // dd($data);

        $fee = Fee::findOrFail($id);

        $fee->update($data);

        return to_route('nationalities.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Fee $fee): RedirectResponse
    {
        $fee->delete();
        return to_route('nationalities.index')->with('success', 'تم الحذف بنجاح');
    }
}

