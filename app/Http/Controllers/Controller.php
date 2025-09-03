<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Simat;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function statistics(Request $request)
    {
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
        } else {
            $fromDate = Carbon::today()->startOfDay();
            $toDate = Carbon::today()->endOfDay();
        }

        $cargo = Insurance::where('type', 'Cargo')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->get();

        $tourist = Insurance::where('type', 'Tourist')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->get();

        $simats = Simat::whereBetween('created_at', [$fromDate, $toDate])
            ->get();

        return view('dashboard', compact(
            'cargo',
            'tourist',
            'simats',
            'fromDate',
            'toDate'
        ));
    }
}
