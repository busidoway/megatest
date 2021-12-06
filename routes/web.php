<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestBoxesController;

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/tests', [TestBoxesController::class, 'getDataTests'])->name('tests');

// Route::get('/test/{id}', [TestBoxesController::class, 'getTest'])->name('data-test');

Route::get('/test/{id}', function () {
    return view('test');
})->name('data-test');

Auth::routes();

Route::get('/admin', function () {
    return view('admin.admin');
});

// Route::get('admin/tests/{id}', 'TestsController@index');


Route::get('/admin/{any}', function () {
    return view('admin.admin');
})->where('any', '.*');

// Route::get('/admin/tests/{id}', [App\Http\Controllers\TestsController::class, 'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');