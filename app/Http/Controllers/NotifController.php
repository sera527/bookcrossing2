<?php

namespace Bookcrossing\Http\Controllers;

use Illuminate\Http\Request;

use Bookcrossing\Book;
use Bookcrossing\Http\Requests;

use Fenos\Notifynder\Facades\Notifynder;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNotifications = Notifynder::getAll(session()->get('VKusr'));
        $notifications = [];
        foreach($allNotifications as $n)
        {
            switch($n->category_id)
            {
                case 11:
                    $extra = json_decode($n->extra, true);
                    $str = <<<HEREDOC
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture">
                </div>

                <div class="cd-timeline-content">
                    <h2>Заявку на книгу подано!</h2>
                    <p>Заявку на отримання книги <a href="/$extra[bookId]">"$extra[bookName]"</a> здійснено.</p>
                    <a href="https://vk.com/id$n->from_id" target='_blank' class="btn btn-raised btn-primary btn-sm">Зв'язатися з власником</a>
                    <a href="/cancel?id1=$extra[wantId]&id2=$n->id" class="btn btn-primary btn-sm" id="$n->id" onclick="$('#$n->id').attr('disabled', 'disabled')">Скасувати заявку</a>
                    <span class="cd-date"><time>$n->created_at</time></span>
                </div>
            </div>
HEREDOC;
                    array_push($notifications, $str);
                    break;
                case 21:
                    $extra = json_decode($n->extra, true);
                    $name = IndexController::getName($n->from_id);
                    $read = "";
                    if($n->read == 1)
                    {
                        $read = " disabled='disabled'";
                    }
                    $str = <<<HEREDOC
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture"></div>
                <div class="cd-timeline-content">
                    <h2>Твою книгу хочуть взяти!</h2>
                    <p>Твою книгу <a href="/$extra[bookId]">"$extra[bookName]"</a> хоче взяти <a class="$n->id" href="https://vk.com/id$n->from_id" target='_blank'>$name</a>.</p>
                    <a$read href="https://vk.com/id$n->from_id" target='_blank' class="btn btn-raised btn-primary btn-sm">Зв'язатися з бажаючим</a>
                    <a$read href="/accept?id=$extra[bookId]&user=$n->from_id&n=$n->id" id="$n->id-1" class="btn btn-raised btn-primary btn-sm" onclick="$('#$n->id-1').attr('disabled', 'disabled'); $('#$n->id-2').attr('disabled', 'disabled')">Я здійснив передачу книги</a>
                    <a$read href="/refusal?type=refusal&id=$extra[bookId]&user=$n->from_id&n=$n->id" id="$n->id-2" class="btn btn-primary btn-sm" onclick="$('#$n->id-1').attr('disabled', 'disabled'); $('#$n->id-2').attr('disabled', 'disabled')">Я не хочу давати книгу цій людині</a>
                    <span class="cd-date"><time>$n->created_at</time></span>
                </div>
            </div>
HEREDOC;
                    array_push($notifications, $str);
                    break;
                case 31:
                    $extra = json_decode($n->extra, true);
                    $read = "";
                    if($n->read == 1)
                    {
                        $read = " disabled='disabled'";
                    }
                    $str = <<<HEREDOC
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-movie"></div>
                <div class="cd-timeline-content">
                    <h2>Будь ласка, поверни книгу!</h2>
                    <p>На жаль, <a href="https://vk.com/id$n->from_id" target='_blank'>власник</a> книги <a href="/$extra[bookId]">"$extra[bookName]"</a> хоче забрати її. Будь ласка, зв'яжися з ним і поверни книгу.</p>
                    <a$read href="https://vk.com/id$n->from_id" target='_blank' class="btn btn-raised btn-primary btn-sm">Зв'язатися з власником</a>
                    <a$read href="/returnToOwner?id=$extra[bookId]&n=$n->id" id="$n->id" class="btn btn-raised btn-primary btn-sm" onclick="$('#$n->id').attr('disabled', 'disabled')">Я повернув книгу</a>
                    <span class="cd-date"><time>$n->created_at</time></span>
                </div>
            </div>
HEREDOC;
                    array_push($notifications, $str);
                    break;
                case 41:
                    $extra = json_decode($n->extra, true);
                    $str = <<<HEREDOC
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-movie"></div>
                <div class="cd-timeline-content">
                    <h2>Відмова :(</h2>
                    <p>На жаль, <a href="https://vk.com/id$n->from_id" target='_blank'>власник</a> не захотів дати тобі книгу <a href="/$extra[bookId]">"$extra[bookName]"</a>. Що ж, таке буває.</p>
                    <span class="cd-date"><time>$n->created_at</time></span>
                </div>
            </div>
HEREDOC;
                    array_push($notifications, $str);
                    break;
                default:
                    echo "ololo";
            }
        }

        $notReadNotifications = Notifynder::getNotRead(session()->get('VKusr'));
        foreach($notReadNotifications as $m)
        {
            if($m->category_id == 41||$m->category_id == 11)
            Notifynder::readOne($m->id);
        }

        return view('notifications', ['version' => IndexController::version(), 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        switch($request->input('type'))
        {
            case "return":
                $book = Book::find($request->input('id'));
                $bookName = $book->name;
                $bookId = $request->input('id');
                if($book->user == session()->get('VKusr'))
                {
                    Notifynder::category('return')
                        ->from($book->user)
                        ->to($book->current_owner)
                        ->url('/')
                        ->extra(compact('bookName', 'bookId'))
                        ->send();
                }
                return redirect('/myBooks');
                break;
            case "takingBook":
                $book = Book::find($request->input('id'));
                $bookName = $book->name;
                $bookId = $request->input('id');
            //хтось хоче взяти твою книгу
        Notifynder::category('want')
            ->from(session()->get('VKusr'))
            ->to($book->current_owner)
            ->url('/')
            ->extra(compact('bookName', 'bookId'))
            ->send();
        $wantId = Notifynder::getLastNotification($book->current_owner);
        $wantId = $wantId->id;
            //заявка на книгу
        Notifynder::category('request')
            ->from($book->current_owner)
            ->to(session()->get('VKusr'))
            ->url('/')
            ->extra(compact('bookName', 'bookId', 'wantId'))
            ->send();
        return redirect('/notifications');
                break;
            case "refusal":
                Notifynder::readOne($request->input('n'));
                $book = Book::find($request->input('id'));
                $bookName = $book->name;
                $bookId = $request->input('id');
                //Власник відмовився дати тобі книгу
                Notifynder::category('refusal')
                    ->from(session()->get('VKusr'))
                    ->to($request->input('user'))
                    ->url('/')
                    ->extra(compact('bookName', 'bookId'))
                    ->send();
                return redirect('/notifications');
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Notifynder::delete($request->input('id1'));
        Notifynder::delete($request->input('id2'));
        return redirect('/notifications');
    }
}
