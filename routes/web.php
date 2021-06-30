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

// Route::get('/allBooks', function () {
//     return view('allBooks');
// })->middleware(['auth'])->name('allBooks');

Route::get('/my-books', [BookController::class, 'getBooksForUser'])->middleware(['auth'])->name('myBooks');

// Route::get('/myBooks', function () {
//     return view('myBooks');
// })->middleware(['auth'])->name('myBooks');

require __DIR__.'/auth.php';
