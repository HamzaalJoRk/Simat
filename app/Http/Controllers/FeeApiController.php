<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeApiController extends Controller
{
    public function getFeesByNationalityAndType(Request $request)
    {
        $nationalityId = $request->query('nationality_id');
        $type = $request->query('type');

        $fees = Fee::where('nationalities_id', $nationalityId)
            ->where('type', $type)
            ->get(['id', 'type', 'duration', 'amount']);

        return response()->json($fees);
    }
}
