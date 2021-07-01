<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    }


    public function getBooksForUser() {
        $books = Book::where('user_id', Auth::user()->id)->get();
        return view('pages.list_books')->with(['books' => $books]);
    }

    public function getAllBooks() {
        $books = Book::all();
        return view('pages.list_books')->with(['books' => $books]);
    }

    public function createNewBook(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }

        Book::create([
            'name' => $request->name,
            'ISBN' => $request->isbn,
            'year' => $request->year,
            'description' => $request->description,
            'coverImage' => $request->coverImage,
            'user_id' => $user->id
        ]);

        return back()->with('successMessage', 'Book created successfully.');
    }
}
