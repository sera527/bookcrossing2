@extends('base')

@section('main')
    <div class='row'>
        <div class='col-lg-5'>
            @if($book->photo == "")
                <img src='/images/default.jpg' style="width:100%" alt='{{ $book->name }}'>
            @else
                <img src='{{ $book->photo }}' style="width:100%" alt='{{ $book->name }}' data-toggle="modal" data-target="#simple-dialog">
            @endif
        </div>
        <div id='info' class='col-lg-7'>
            <p><b>Назва: </b>{{ $book->name }}</p>

            <p><b>Автор: </b>{{ $book->author }}</p>

            <p><b>Мова: </b>{{ $book->lang }}</p>
            @if($book->year>0)
            <p><b>Рік: </b><time>{{ $book->year }}</time></p>
            @endif
            <p><b>Опис: </b><br>{{ $book->description }}</p>

            <p><b>@if($book->taken == 1)
                        Читає:
                    @else
                        Віддає:
                    @endif </b><a class="{{ $book->current_owner }}" target='_blank' href='https://vk.com/id{{ $book->current_owner }}'>користувач</a></p>
            @if($book->user == session()->get('VKusr'))
                <p>Це твоя книга. Керувати нею можна в розділі "Мій кабінет" -> "Мої книги".</p>
            @elseif($book->current_owner == session()->get('VKusr'))
                <p>Ти зараз читаєш цю книгу.</p>
            @elseif($book->taken == 1)
                <p>Цю книгу зараз читають.</p>
            @elseif($s)
                <p>Ти зможеш взяти цю книгу, коли повернеш в книгооберт <a href="/takenBook">вже взяту книгу</a>.</p>
            @else
                <a href="/take?type=takingBook&id={{ $book->id }}" id="take" class='btn btn-raised btn-primary' onclick="$('#take').attr('disabled', 'disabled')">Взяти книгу</a>
            @endif
        </div>
        </div>
    <h4>Обговорити книгу</h4>
<div class="row">
    <div id="vk_comments" class="center-block"></div>
</div>
    <script>
        VK.Widgets.Comments("vk_comments", {limit: 10, width: "auto !important", attach: {{ $book->id }} });
    </script>

    <div id="simple-dialog" class="modal fade" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img src='{{ $book->photo }}' style="width:100%" alt='{{ $book->name }}'>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    $(window).load(function () {
        VK.Api.call('users.get', {user_ids: {{ $book->current_owner }} }, function (r) {
            if (r.response) {
                aa = r.response[0].first_name + ' ' + r.response[0].last_name;
                $('a.{{ $book->current_owner }}').text(aa);
            }
        });
    });
@stop