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
        Session::put('homenew_uri', $_SERVER['REQUEST_URI']);

        $mainCategories = Category::orderBy('id')->take(6)->get();

        $popularCategories = Category::leftJoin('listings as l', 'categories.id', '=', 'l.category_id')
            ->selectRaw('categories.*, count(l.category_id) as category_count')
            ->groupBy('categories.id')
            ->orderBy('category_count', 'desc')
            ->take(4)
            ->get();

        if(auth()->guard()->guest() || Auth::user()->getRole() == 'client') {
            $sliderTasks = Listing::selectRaw('listings.*, r.rating')
                ->leftJoin('reviews as r', 'r.task_id', '=', 'listings.id')
                ->where('approve', true)
                ->whereRaw('listings.assistant_id IS NOT NULL')
                ->where(function($qs) {
                    $qs->where('listings.status_id', config('constants.statuses.completed_by_client'));
                    $qs->orWhere('listings.status_id', config('constants.statuses.completed_by_admin'));
                })
                ->orderBy('listings.updated_at', 'desc')
                ->limit(20)
                ->get();
        } else {
            $sliderTasks = Listing::where('listings.end_task_date', '>', Carbon::now()->subHours(2))
            ->where('listings.approve', true)
            ->where('listings.status_id', config('constants.statuses.approved'))
            ->whereRaw('listings.assistant_id IS NULL')
            ->limit(20)
            ->get();
        }


        return view('pages.homenew', [
            'mainCategories'     => $mainCategories,
            'sliderTasks'        => $sliderTasks,
            'notificationsCount' => 0
        ]);
    }

    public function getTaskByUrl($taskUrl) {

        // dd($taskUrl);

        // if there is no task link, abort.
        if(is_null($taskUrl)) {
            abort(403, 'Unauthorized action.');
        }
        
        // $choosenTask = Listing::find($taskUrl);
        $choosenTask = Listing::where('listings.slug', $taskUrl)->first();

        // if there is no such task/not existing abort.
        if(is_null($choosenTask)) {
            abort(404, '404 Not found.');
        }

        // dd($choosenTask);
        
        // task address
        $choosenTaskLocation = $choosenTask->location->name .' ('. $choosenTask->location->region .'), п.к.'. $choosenTask->location->post_code;
        
        // task full address with check if there is a street address or not.
        $choosenTaskLocationAddress = $choosenTask->location->name .' ('. $choosenTask->location->region .'), п.к.'. $choosenTask->location->post_code . (!is_null($choosenTask->address) ? ', ' . $choosenTask->address : '');
        
        // dd(
        //     $choosenTaskLocation,
        //     $choosenTaskLocationAddress
        // );

        $choosenTaskPrice = $choosenTask->price;
        $choosenTaskPrice2 = GeneralHelper::priceFormat($choosenTask->price);

        return view('pages.taskdetails', [
            'choosenTask' => $choosenTask,
            'choosenTaskLocation' => $choosenTaskLocation,
            'ChoosenTaskPrice' => $choosenTaskPrice,
            'ChoosenTaskPrice2' => $choosenTaskPrice2
        ]);

    }

    public function getBooksForUser() {
        $books = Book::where('user_id', Auth::user()->id)->get();
        return view('pages.my_books')->with(['books' => $books]);
    }

    public function getAllBooks() {
        $books = Book::all();
        return view('pages.all_books')->with(['books' => $books]);
    }

    public function createNewBook(Request $request) {
        $user = Auth::user();

        if(!$user) {
            return abort(403, 'Unauthorized action.');
        }

        $books = Book::all();
        return view('pages.allBooks')->with(['books' => $books]);
    }
}
