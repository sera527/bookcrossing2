@extends('base')

@section('active4', "class='active'")
@section('active9', "active")

@section('main')
    @if ($count > 0)
        <p class="pull-right">Всього книг: <span class="badge">{{$count}}</span></p>
    @else
        <h2>Тобою ще не додано жодної книги!</h2>
    @endif
    @if (count($my) > 0)
        <h2>Книги в тебе:</h2>
    @endif
    @foreach($my as $book)
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
                <a href="/{{ $book->id }}" class='btn btn-raised btn-primary'>Детальніше</a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $book->id }}">Редагувати</button>
                <a href="/destroy?id={{ $book->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Вилучити з книгооберту">Вилучити</a>
            </div>
        </div>
        <div class="modal fade" id="myModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Змінити дані книги</h4>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="form-horizontal" action="/update" method="post">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="name">Назва</label>
                                    <input type="text" class="form-control" name="name" value='{{ $book->name }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="author">Автор</label>
                                    <input type="text" class="form-control" name="author" value='{{ $book->author }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="lang">Мова книги</label>
                                    <input type="text" class="form-control" name="lang" value='{{ $book->lang }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="year">Рік видання</label>
                                    <input type="number" min="1900" max="2016" class="form-control" name="year" value='{{ $book->year }}'>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="photo" accept="image/*">
                                    <div class="input-group">
                                        <input type="text" readonly="" class="form-control" placeholder="Завантажити інше фото до 2 Мб">
      <span class="input-group-btn input-group-sm">
        <button type="button" class="btn btn-fab btn-fab-mini">
            <i class="material-icons">attach_file</i>
        </button>
      </span>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="description">Опис книги</label>
                                    <textarea rows="5" name="description" class="form-control" maxlength="800">{{ $book->description }}</textarea>
                                    <p class="help-block">до 800 знаків</p>
                                </div>
                                <!--<div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="send"> Можу вислати книгу поштою
                                        </label>
                                    </div>
                                    <p class="help-block">Функція у розробці</p>
                                </div>-->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $book->id }}">
                                <input type="hidden" name="usr">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                                    <input type="submit" class="btn btn-raised btn-primary">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if (count($my0) > 0)
        <h2>Твої книги, які хтось читає:</h2>
    @endif
    @foreach($my0 as $book)
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
                <p><b>Зараз читає </b><a id='{{ $book->id }}' target='_blank' href='https://vk.com/id{{ $book->current_owner }}'>{{ $book->user_name }}</a></p>
                <a href="/{{ $book->id }}" class='btn btn-raised btn-primary'>Детальніше</a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $book->id }}">Редагувати</button>
                <a href="/createN?type=return&id={{ $book->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Забрати книгу в читача">Забрати</a>
            </div>
        </div>

        <div class="modal fade" id="myModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Змінити дані книги</h4>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="form-horizontal" action="/update" method="post">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="name">Назва</label>
                                    <input type="text" class="form-control" name="name" value='{{ $book->name }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="author">Автор</label>
                                    <input type="text" class="form-control" name="author" value='{{ $book->author }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="lang">Мова книги</label>
                                    <input type="text" class="form-control" name="lang" value='{{ $book->lang }}' required>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="year">Рік видання</label>
                                    <input type="number" min="1900" max="2016" class="form-control" name="year" value='{{ $book->year }}'>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="photo" accept="image/*">
                                    <div class="input-group">
                                        <input type="text" readonly="" class="form-control" placeholder="Завантажити інше фото до 2 Мб">
      <span class="input-group-btn input-group-sm">
        <button type="button" class="btn btn-fab btn-fab-mini">
            <i class="material-icons">attach_file</i>
        </button>
      </span>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label" for="description">Опис книги</label>
                                    <textarea rows="5" name="description" class="form-control" maxlength="800">{{ $book->description }}</textarea>
                                    <p class="help-block">до 800 знаків</p>
                                </div>
                                <!--<div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="send"> Можу вислати книгу поштою
                                        </label>
                                    </div>
                                    <p class="help-block">Функція у розробці</p>
                                </div>-->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $book->id }}">
                                <input type="hidden" name="usr">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                                    <input type="submit" class="btn btn-raised btn-primary">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

@stop