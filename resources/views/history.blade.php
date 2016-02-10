@extends('base')

@section('active5', "class='active'")

@section('main')
    @foreach($events as $event)
        @if($event->to == 0)
            <div class="panel panel-success">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <p>Користувач <a class="{{ $event->from }}" target="_blank" href="https://vk.com/id{{ $event->from }}">користувач</a> додав книгу <a href="/{{ $event->book }}">"{{ $event->name3 }}"</a>.<time class="pull-right">{{ $event->updated_at }}</time></p>
                </div>
            </div>
        @elseif($event->from == 0)
            <div class="panel panel-danger">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <p>Користувач <a class="{{ $event->to }}" target="_blank" href="https://vk.com/id{{ $event->to }}">користувач</a> вилучив книгу <a href="/{{ $event->book }}">"{{ $event->name3 }}"</a> з книгооберту.<time class="pull-right">{{ $event->updated_at }}</time></p>
                </div>
            </div>
        @else
            <div class="panel panel-primary">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <p>Користувач <a class="{{ $event->from }}" target="_blank" href="https://vk.com/id{{ $event->from }}">користувач</a> передав користувачу <a class="{{ $event->to }}" target="_blank" href="https://vk.com/id{{ $event->to }}">користувач</a> книгу <a href="/{{ $event->book }}">"{{ $event->name3 }}"</a>.<time class="pull-right">{{ $event->updated_at }}</time></p>
                </div>
            </div>
        @endif
    @endforeach
    {{ $events->links() }}
@stop

@section('javascript')
    $(window).load(function () {
    @foreach($events as $event)
        @if($event->from != 0)
        VK.Api.call('users.get', {user_ids: {{ $event->from }} }, function (r) {
            if (r.response) {
                aa = r.response[0].first_name + ' ' + r.response[0].last_name;
                $('a.{{ $event->from }}').each(function(indx, element){
                    $(element).text(aa);
                });
            }
        });
        @endif
        @if($event->to != 0)
            VK.Api.call('users.get', {user_ids: {{ $event->to }} }, function (r) {
                if (r.response) {
                    aa = r.response[0].first_name + ' ' + r.response[0].last_name;
                    $('a.{{ $event->to }}').each(function(indx, element){
                        $(element).text(aa);
                    });
                }
            });
        @endif
    @endforeach
    });
@stop
