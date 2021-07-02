<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFavourites;
use App\Models\Book;
use File;
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

    public function getFavouriteBooks() {
        $userId = Auth::user()->id;
        //$books = Book::where('user_id', $userId)->get();
        $favouriteBooks = UserFavourites::where('user_id', Auth::user()->id)->get();
        $favBookIds = array();
        foreach ($favouriteBooks as $favBook) {
            array_push($favBookIds, $favBook->book_id);
        }
        $userBooks = Book::whereIn('id', $favBookIds)->get();
        return view('pages.list_books')->with(['books' => $userBooks, 'favBooks' => $favBookIds]);
    }

    public function getBooksForUser() {
        $books = Book::where('user_id', Auth::user()->id)->get();
        $favouriteBooks = UserFavourites::where('user_id', Auth::user()->id)->get();
        $favBooks = array();
        foreach ($favouriteBooks as $favBook) {
            array_push($favBooks, $favBook->book_id);
        }

        return view('pages.list_books')->with(['books' => $books, 'favBooks' => $favBooks]);
    }

    public function getAllBooks() {
        $books = Book::all();
        $favouriteBooks = UserFavourites::where('user_id', Auth::user()->id)->get();
        $favBooks = array();
        foreach ($favouriteBooks as $favBook) {
            array_push($favBooks, $favBook->book_id);
        }

        return view('pages.list_books')->with(['books' => $books, 'favBooks' => $favBooks]);
    }

    public function createNewBook(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);
        Book::create([
            'name' => $request->name,
            'ISBN' => $request->isbn,
            'year' => $request->year,
            'description' => $request->description,
            'coverImage' => '/images/'.$imageName,
            'user_id' => $user->id
        ]);

        return back()->with('successMessage', 'Book created successfully.');
    }

    public function editBook(Request $request) {
        $user = Auth::user();
        $bookId = $request->id;

        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }

        $book = Book::find($bookId);

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->image){
            $imageName = time().'.'.$request->image->extension();      
            $request->image->move(public_path('images'), $imageName);
    
            //If we're updating the image, delete the old one
            if($request->image){
                if(file_exists(getcwd().$book->coverImage)){
                    unlink(getcwd().$book->coverImage);
                    
                }
            }
            $book->coverImage = '/images/'.$imageName;
        }

        $book->name = $request->name;
        $book->description = $request->description;
        $book->ISBN = $request->isbn;
        $book->year = $request->year;
        $book->save();
        return back()->with('successMessage', 'Book edited successfully.');
    }

    public function deleteBook(Request $request) {
        $user = Auth::user();
        $bookId = $request->id;
        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }

        // $book = Book::where('id', $bookId);
        $book = Book::find($bookId);
        $book->delete();
        return back()->with('successMessage', 'Book deleted successfully.');
    }

    public function addRemoveBookToFavourites(Request $request) {
        $user = Auth::user();
        $bookId = $request->id;
        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }

        $book = UserFavourites::where('user_id', $user->id)->where('book_id', $bookId)->first();
        //If we find a book, then we want to remove it
        if(is_null($book)){
            UserFavourites::create([
                'book_id' => $bookId,
                'user_id' => $user->id
            ]);
            return response()->json(['action' => 'added']);

        }else{
            $book->delete();
            return response()->json(['action' => 'deleted']);
        }

    }
    public function viewBook(Request $request) {
        $book = Book::find($request->id);
        return view('pages.single_book')->with(['book' => $book]);
    }

}
