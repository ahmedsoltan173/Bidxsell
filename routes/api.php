<?php

use App\Http\Controllers\API\ProblemSolvingPart\CipherEncoderController;
use App\Http\Controllers\API\ProblemSolvingPart\JsonFlattenerController;
use App\Http\Controllers\API\ProblemSolvingPart\NumberToExcelController;
use App\Http\Controllers\API\Ticketing\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('numberToExcel/{index}',NumberToExcelController::class);
Route::get('cipherEncoder/{input_string}/{shift}',CipherEncoderController::class);
Route::get('jsonFlatttener/{input_json}',JsonFlattenerController::class);


Route::get('events',[TicketController::class,'all_events']);
Route::post('events/create',[TicketController::class,'createEvent']);
