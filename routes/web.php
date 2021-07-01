<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/my-books', [BookController::class, 'getBooksForUser'])->middleware(['auth'])->name('myBooks');
Route::get('/all-books', [BookController::class, 'getAllBooks'])->middleware(['auth'])->name('allBooks');
Route::post('/new-book', [BookController::class, 'createNewBook'])->middleware(['auth'])->name('newBook');
Route::post('/edit-book', [BookController::class, 'editBook'])->middleware(['auth'])->name('editBook');
Route::post('/delete-book/{id}', [BookController::class, 'deleteBook'])->middleware(['auth']);

// Route::get('/new-book', function () {
//     return view('new_book');
// })->middleware(['auth'])->name('newBook');

require __DIR__.'/auth.php';
