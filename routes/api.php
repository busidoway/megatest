<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestBoxesController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\TestItemsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('test_boxes', TestBoxesController::class);

// Route::resource('tests', TestsController::class);

Route::get('tests/{id}', [TestsController::class, 'index']);

Route::post('tests/{id}/question', [TestsController::class, 'store']);

Route::post('tests/{id}/question/{qid}', [TestItemsController::class, 'store']);