<?php

use App\Http\Controllers\FeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/fees', function (Request $request) {
    $request->validate([
        'nationality_id' => 'required|exists:nationalities,id',
        'type' => 'required|string',
    ]);

    $fees = Fee::where('nationality_id', $request->nationality_id)
        ->where('type', $request->type)
        ->get(['id', 'type', 'duration', 'amount']);

    return response()->json($fees);
});