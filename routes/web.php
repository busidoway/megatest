<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestBoxesController;
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test/{any}', function () {
//     return view('test');
// })->where('any', '.*');

// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', [StudentsController::class, 'getStudents'])->name('home');

Route::post('/student/select', [StudentsController::class, 'selectStudent'])->name('select_student');

Route::get('/tests', [TestBoxesController::class, 'getDataTests'])->name('tests');

// Route::get('/test/{id}', [TestBoxesController::class, 'getTest'])->name('data-test');

Route::get('/test/{id}', function () {
    return view('test');
})->name('data-test');

Auth::routes(['register'=>false]);

Route::get('/admin', function () {
    return view('admin.admin');
})->middleware('auth');

// Route::get('admin/tests/{id}', 'TestsController@index');

Route::get('/account', function () {
    return view('auth.account');
})->name('account');

Route::post('/test/rand', [TestBoxesController::class, 'getRandTestBox'])->name('test_box_rand');

// Route::post('/test/{id}/result', [TestBoxesController::class, 'getResult'])->name('get_result');

Route::get('/admin/{any}', function () {
    return view('admin.admin');
})->where('any', '.*')->middleware('auth');

// Route::get('/admin/tests/{id}', [App\Http\Controllers\TestsController::class, 'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');