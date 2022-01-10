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

    //libraries
    Route::get('libraries', [\App\Http\Controllers\LibraryController::class, 'index'])->name('libraries');
    Route::post('libraries', [\App\Http\Controllers\LibraryController::class, 'store'])->name('store.library');
    Route::delete('delete/library/{library}', [\App\Http\Controllers\LibraryController::class, 'destroy'])->name('delete.library');
    Route::put('update/library/{library}', [\App\Http\Controllers\LibraryController::class, 'update'])->name('update.library');


    Route::get('books', [\App\Http\Controllers\BookController::class, 'index'])->name('manage.books');
    Route::get('editbook', [\App\Http\Controllers\BookController::class, 'edit'])->name('manage.books');
    Route::put('/updatebook/{id}', [BookController::class, 'update'])->name('updatebook');
    Route::post('books', [\App\Http\Controllers\BookController::class, 'store'])->name('store.book');
    Route::delete('books', [\App\Http\Controllers\BookController::class, 'destroy'])->name('delete.book');
    Route::put('books', [\App\Http\Controllers\BookController::class, 'update'])->name('update.book');


    Route::get('borrowings', [\App\Http\Controllers\LibraryController::class, 'index'])->name('borrowings');

});

Route::group(['middleware' => ['role:student', 'auth']], function () {
    Route::get('/student/dashboard', function () {
      return view('students.dashboard');
    })->name('student.dashboard');
});

require __DIR__.'/auth.php';
