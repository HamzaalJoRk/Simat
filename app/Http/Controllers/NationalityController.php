<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NationalityController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $query = Nationality::with('fees')->latest();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $nationalities = $query->paginate(10)->withQueryString(); // 10 بالصفحة، ويحافظ على معلمات الاستعلام (search)

        return view('pages.nationalities.index', compact('nationalities'));
    }



    public function create(): View
    {
        return view('pages.nationalities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:nationalities',
        ]);

        Nationality::create($data);

        return to_route('nationalities.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(Nationality $nationality): View
    {
        $nationality->load(['fees', 'simats']);
        return view('pages.nationalities.show', compact('nationality'));
    }

    public function edit($id): View
    {
        $nationality = Nationality::findOrFail($id);
        return view('pages.nationalities.edit', compact('nationality'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $nationality = Nationality::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:nationalities,name,' . $nationality->id,
        ]);

        $nationality->update($data);

        return to_route('nationalities.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy($id): RedirectResponse
    {
        $nationality = Nationality::findOrFail($id);
        $nationality->fees()->delete();

        $nationality->delete();

        return to_route('nationalities.index')->with('success', 'تم الحذف بنجاح');
    }

}

