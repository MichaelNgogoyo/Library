<?php

use App\Http\Controllers\BookController;
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
    Route::get('editbook/{id}', [\App\Http\Controllers\BookController::class, 'edit'])->name('manage.edit');
    Route::put('/updatebook/{id}', [\App\Http\Controllers\BookController::class, 'update'])->name('updatebook');
    Route::post('books', [\App\Http\Controllers\BookController::class, 'store'])->name('store.book');
    Route::delete('delete/books/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('delete.book');
    Route::put('update/books/{book}', [\App\Http\Controllers\BookController::class, 'update'])->name('update.book');

    Route::get('borrowings', [\App\Http\Controllers\BorrowingController::class, 'index'])->name('borrowings');
    Route::post('borrowings', [\App\Http\Controllers\BorrowingController::class, 'store'])->name('store.borrowings');

});

Route::group(['middleware' => ['role:student', 'auth'], 'as'=>'student.'], function () {
    Route::get('/student/dashboard', function () {
      return view('students.dashboard');
    })->name('dashboard');

    Route::get('student/borrowings', [\App\Http\Controllers\BorrowingController::class, 'studentIndex'])->name('borrowings');
     Route::post('student/borrowings', [\App\Http\Controllers\BorrowingController::class, 'storeStudent'])->name('store.borrowings');

     Route::put('update/student/borrowings/{borrowing}', [\App\Http\Controllers\BorrowingController::class, 'update'])->name('update.borrowings');


});

require __DIR__.'/auth.php';
