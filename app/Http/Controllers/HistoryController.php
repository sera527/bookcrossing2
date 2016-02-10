<?php

namespace Bookcrossing\Http\Controllers;

use Bookcrossing\Http\Requests;

use Bookcrossing\History;
use Bookcrossing\Book;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('count');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = History::orderBy('updated_at', 'desc')->simplePaginate(10);

        foreach($events as $event)
        {
            $event->name3 = Book::withTrashed()->find($event->book)->name;
        }

        return view('history', ['events' => $events, 'version' => IndexController::version(), 'Not' => session()->get('count')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($from, $to, $book)
    {
        History::create(['from' => $from, 'to' => $to, 'book' => $book]);
    }
}
