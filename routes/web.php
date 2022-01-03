<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['role:librarian', 'auth']], function () {
    Route::get('/dashboard', function () {
      return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['role:student', 'auth']], function () {
    Route::get('/student/dashboard', function () {
      return view('students.dashboard');
    })->name('student.dashboard');
});

require __DIR__.'/auth.php';
