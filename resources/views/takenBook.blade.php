@extends('base')

@section('active8', "class='active'")
@section('active9', "active")

@section('main')
    @if (count($books)>0)
        @foreach($books as $book)
            <div style='padding: 10px' class='book" + r[i][0] + " row'>
                <div class='col-lg-3'>
                    @if($book->photo == "")
                        <img src='/images/default.jpg' style="width:100%" alt='{{ $book->name }}'>
                    @else
                        <img src='{{ $book->photo }}' style="width:100%" alt='{{ $book->name }}'>
                    @endif
                </div>
                <div class='col-lg-9'>
                    <p><b>Назва: </b>{{ $book->name }}</p>
                    <p><b>Автор: </b>{{ $book->author }}</p>
                    <p><b>Мова: </b>{{ $book->lang }}</p>
                    @if($book->year>0)
                        <p><b>Рік: </b><time>{{ $book->year }}</time></p>
                    @endif
                    <p><b>Власник: </b><a id='book' target='_blank' href='https://vk.com/id{{ $book->user }}'>{{ $book->user_name }}</a></p>
                    <a href="/{{ $book->id }}"><button class='btn btn-primary'>Детальніше</button></a>
                    @if($book->taken == 1)
                        <a href="/return?id={{ $book->id }}"><button class="btn btn-primary btn-raised" data-toggle="tooltip" data-placement="top" title="" data-original-title="Повернути в книгооберт">Книгу прочитано!</button></a>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <h4>Зараз ти не взяв жодної книги, але ти можеш це зробити у розділі "Вільні книжки".</h4>
    @endif
@stop