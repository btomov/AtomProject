<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/all-books');
})->middleware(['auth'])->name('dashboard');

Route::get('/favourite-books', [BookController::class, 'getFavouriteBooks'])->middleware(['auth'])->name('myBooks');
Route::get('/all-books', [BookController::class, 'getAllBooks'])->middleware(['auth'])->name('allBooks');
Route::post('/new-book', [BookController::class, 'createNewBook'])->middleware(['auth'])->name('newBook');
Route::post('/edit-book', [BookController::class, 'editBook'])->middleware(['auth'])->name('editBook');
Route::post('/delete-book/{id}', [BookController::class, 'deleteBook'])->middleware(['auth']);
Route::post('/toggle-favourite-book/{id}', [BookController::class, 'addRemoveBookToFavourites'])->middleware(['auth']);
Route::get('/book/{id}', [BookController::class, 'viewBook'])->middleware(['auth']);

Route::get('/settings', function () {
    return view('pages.settings');
})->middleware(['auth'])->name('settings');

Route::post('/settings', [UserController::class, 'editUser'])->middleware(['auth'])->name('editUser');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');




// Route::get('/new-book', function () {
//     return view('new_book');
// })->middleware(['auth'])->name('newBook');

require __DIR__.'/auth.php';
