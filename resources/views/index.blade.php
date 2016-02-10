@extends('base')

@section('active1', "class='active'")

@section('like')
    <div data-toggle="tooltip" data-placement="left" title="" data-original-title="Тисни like, якщо тобі подобається сайт!">
        <div id="vk_like" class="center-block"></div>
        <script type="text/javascript">
            VK.Widgets.Like("vk_like", {type: "button"});
        </script>
    </div>
@stop

@section('main')
    <p class="pull-right">Всього книг: <span class="badge">{{$count}}</span></p>
        @foreach($books as $book)
            <div style='padding: 10px' class='book" + r[i][0] + " row'>
                <div class='col-lg-3'>
                    @if($book->photo == "")
                        <img src='/images/default.jpg' longdesc="/{{ $book->id }}" style="width:100%" alt='{{ $book->name }}'>
                    @else
                        <img src='{{ $book->photo }}' longdesc="/{{ $book->id }}" style="width:100%" alt='{{ $book->name }}'>
                    @endif
                </div>
                <div class='col-lg-9'>
                    <p><b>Назва: </b>{{ $book->name }}</p>
                    <p><b>Автор: </b>{{ $book->author }}</p>
                    <p><b>Мова: </b>{{ $book->lang }}</p>
                    @if($book->year>0)
                    <p><b>Рік: </b><time>{{ $book->year }}</time></p>
                    @endif
                    <p><b>Віддає: </b><a class='{{ $book->current_owner }}' target='_blank' href='https://vk.com/id{{ $book->current_owner }}'>користувач</a></p>
                    <a href="/{{ $book->id }}" class='btn btn-raised btn-primary'>Детальніше</a>
                </div>
            </div>
        @endforeach
    {{ $books->links() }}
@stop

@section('javascript')
    $(window).load(function () {
    @foreach($books as $book)
        VK.Api.call('users.get', {user_ids: {{ $book->current_owner }} }, function (r) {
            if (r.response) {
                aa = r.response[0].first_name + ' ' + r.response[0].last_name;
                $('a.{{ $book->current_owner }}').each(function(indx, element){
                        $(element).text(aa);
                });
            }
        });
    @endforeach
    });
@stop
