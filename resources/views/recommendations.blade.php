@extends('base')

@section('active7', "class='active'")

@section('main')
    <h4>Наведені нижче книги ви можете взяти у <strong>Барській районній бібліотеці для дітей</strong>.</h4><address>м. Бар, вул. Героїв Майдану, 19</address>
    <a target="_blank" href="https://vk.com/barchildlib">Спільнота бібліотеки у Вконтакті</a>
    <p class="pull-right">Всього рекомендацій: <span class="badge">{{$count}}</span></p>
    <p>Електронна пошта бібліотеки: <a href='mailto:Barchildlib@bigmir.net'>Barchildlib@bigmir.net</a></p>
    @foreach($posts as $post)
        {!!$post['post']!!}
    @endforeach
    {{ $posts->links() }}
@stop