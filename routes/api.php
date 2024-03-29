<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestBoxesController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\TestItemsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\MembersController;

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

Route::get('tests/del/{id}', [TestsController::class, 'destroy']);

Route::post('tests/{id}/q', [TestsController::class, 'store']);

Route::post('tests/{id}/q/{qid}', [TestsController::class, 'update']);

Route::post('tests/q/note/{qid}', [TestsController::class, 'updateNote']);

Route::get('tests/q/edit/{qid}', [TestsController::class, 'edit']);

Route::post('tests/q/{qid}/item/{id}', [TestItemsController::class, 'store']);

Route::get('tests/q/edit/{qid}/items', [TestItemsController::class, 'edit']);

Route::get('test/items/del/{id}', [TestItemsController::class, 'destroy']);

Route::get('test/{id}', [TestBoxesController::class, 'getTest']);

Route::post('test_box/{id}', [TestBoxesController::class, 'store']);

Route::get('test_box/edit/{id}', [TestBoxesController::class, 'edit']);

Route::post('test_box/note/{id}', [TestBoxesController::class, 'updateNote']);

Route::post('test_box/del/{id}', [TestBoxesController::class, 'destroy']);

Route::post('test_box/{id}/result', [TestBoxesController::class, 'getResult']);

Route::get('test/q/{qid}', [TestItemsController::class, 'index']);

Route::get('students', [StudentsController::class, 'index']);

Route::post('student/store', [StudentsController::class, 'store']);

Route::get('student/edit/{id}', [StudentsController::class, 'edit']);

Route::post('student/update/{id}', [StudentsController::class, 'update']);

Route::get('student/show/{id}', [StudentsController::class, 'show']);

Route::post('student/del/{id}', [StudentsController::class, 'destroy']);

Route::post('student/cheat/{id}', [StudentsController::class, 'toggleCheat']);

Route::get('members', [MembersController::class, 'index']);

Route::post('member/store', [MembersController::class, 'store']);

Route::get('member/edit/{id}', [MembersController::class, 'edit']);

Route::post('member/update/{id}', [MembersController::class, 'update']);

Route::get('member/show/{id}', [MembersController::class, 'show']);

Route::post('member/del/{id}', [MembersController::class, 'destroy']);