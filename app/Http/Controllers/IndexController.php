<?php

namespace Bookcrossing\Http\Controllers;

use Bookcrossing\Book;
use Illuminate\Http\Request;

use Bookcrossing\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Fenos\Notifynder\Facades\Notifynder;

class IndexController extends Controller
{

    function ver(){
        echo "PHP version: ".phpversion();
        echo "<br />Your id: ".session()->get('VKusr');
    }

    function faq(){
        return view('faq', ['version' => IndexController::version(), ]);
    }

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
        $books = Book::where('taken','=', '0')->orderBy('updated_at', 'desc')->simplePaginate(10);
        $count = Book::where('taken','=', '0')->count();

        return view('index', ['books' => $books, 'version' => self::version(), 'count' => $count, 'countNot' => session()->get('count')]);
    }

    static function version(){
//        $fp = fopen('../version.txt', 'r');
//        $version = file_get_contents("../version.txt");
//        fclose($fp);
//        return $version;
        return "v1.0.6";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addBook', ['version' => self::version(), 'countNot' => session()->get('count')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr['name'] = $request->input('name');
        $arr['author'] = $request->input('author');
        $arr['lang'] = $request->input('lang');
        $arr['year'] = $request->input('year');
        $arr['user'] = session()->get('VKusr');
        $arr['taken'] = 0;
        $arr['current_owner'] = session()->get('VKusr');
        $arr['description'] = $request->input('description');

        if(Input::file('photo'))
        {
            $img = $arr['user'].' '.$arr['name'];
            $img = Str::slug($img);
            $extension = Input::file('photo')->getClientOriginalExtension();
            $img = $img.'.'.$extension;
            Input::file('photo')->move('images/books', $img);
            $arr['photo'] = 'images/books/'.$img;
        }

        $book = Book::create($arr);

        HistoryController::create(session()->get('VKusr'), 0, $book->id);
        return redirect('/');
    }

    public static function getName($id)
    {
        $base = 'https://api.vk.com/method/users.get';
        $params = ['user_ids'=>$id];
        $url = $base.'?'.http_build_query($params);
        $response = file_get_contents($url);
        $response = json_decode($response, true);
        if(isset($response['response'][0]['first_name'])&&$response['response'][0]['last_name'])
        {
            return $response = $response['response'][0]['first_name'].' '.$response['response'][0]['last_name'];
        }
        else{
            return "користувач";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $s = false;
        if(Book::whereRaw('current_owner ='.session()->get('VKusr').' and taken = 1')->first())
        {
            $s = true;
        }
        return view('book', ['version' => self::version(), 'book' => $book, 'countNot' => session()->get('count'), 's' => $s]);
    }

    public function getMyBooks()
    {
        $count = Book::where('user', '=', session()->get('VKusr'))->count();
        $myBooks = Book::where('user', '=', session()->get('VKusr'))->orderBy('created_at', 'desc')->get();
        $my = [];
        $my0 = [];

        foreach ($myBooks as $book)
        {
            if($book->user == $book->current_owner)
            {
                array_push($my, $book);
            }else
            {
                array_push($my0, $book);
                $book->user_name = self::getName($book->current_owner);
            }
        }
        return view('myBooks', ['version' => self::version(), 'count' => $count, 'my' => $my, 'my0' => $my0, 'countNot' => session()->get('count')]);
    }

    public function getTakenBook()
    {
        $books = Book::whereRaw('current_owner ='.session()->get('VKusr').' and current_owner <> user')->get();
        if(count($books)>0)
        {
            foreach ($books as $book)
            {
                $book->user_name = self::getName($book->user);
            }
        }
        return view('takenBook', ['version' => self::version(), 'books' => $books, 'countNot' => session()->get('count')]);
    }

    public function returns(Request $request)
    {
        $book = Book::find($request->input('id'));
        if($book->current_owner == session()->get('VKusr'))
        {
            $book->taken = 0;
            $book->save();
        }
        return redirect('/takenBook');
    }

    public function returnToOwner(Request $request)
    {
        $book = Book::find($request->input('id'));
        if($book->current_owner == session()->get('VKusr'))
        {
            $book->taken = 0;
            $book->current_owner = $book->user;
            $book->save();
            Notifynder::readOne($request->input('n'));
        }
        return redirect('/notifications');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::find($request->input('id'));

        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->lang = $request->input('lang');
        $book->year = $request->input('year');
        $book->description = $request->input('description');

        if(Input::file('photo'))
        {
            $img = $book->user.' '.$book->name;
            $img = Str::slug($img);
            $extension = Input::file('photo')->getClientOriginalExtension();
            $img = $img.'.'.$extension;
            Input::file('photo')->move('images/books', $img);
            $book->photo = 'images/books/'.$img;
        }

        $book->save();
        return redirect('/myBooks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        if(isset($id)){
            $book = Book::find($id);
            if($book == null)
            {
                return redirect('/myBooks');
            }
            else
            {
                if($book->user == session()->get('VKusr'))
                {
                    $book->delete();
                    HistoryController::create(0, $book->user, $book->id);
                }
            }
        }
        return redirect('/myBooks');
    }

    public function accept(Request $request)
    {
        $id = $request->input('id');
        if(isset($id)){
            $book = Book::find($id);
            if($book == null)
            {
                return redirect('/');
            }
            else
            {
                if($book->current_owner == session()->get('VKusr'))
                {
                    Notifynder::readOne($request->input('n'));
                    $book->current_owner = $request->input('user');
                    $book->taken = 1;
                    $book->save();
                    HistoryController::create(session()->get('VKusr'), $book->current_owner, $book->id);
                }
            }
        }
        return redirect('/myBooks');
    }
}
