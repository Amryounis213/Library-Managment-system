<?php

use App\Http\Controllers\Api\AllSectionActionController;
use App\Http\Controllers\Api\TitlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Sample API route
Route::get('/profits', [\App\Http\Controllers\SampleDataController::class, 'profits'])->name('profits');

Route::apiResource('titles' , TitlesController::class);

 Route::get('section/{id}' , [AllSectionActionController::class , 'getsubsection']);
 Route::get('subsection/{id}' , [AllSectionActionController::class , 'getSubSub']);
 //Route::get('subsubsection/{id}' , [AllSectionActionController::class , 'getSubSubSub']);
