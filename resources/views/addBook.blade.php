@extends('base')

@section('active9', "active")
@section('active2', "class='active'")

@section('main')
        <div class="well bs-component">
            <form enctype="multipart/form-data" class="form-horizontal" action="/store" method="post">
                <fieldset>
                    <legend>Поділися книгою!</legend>
                    <div class="form-group label-floating">
                        <label class="control-label" for="name">Назва</label>
                        <input type="text" class="form-control" name="name" autofocus required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="author">Автор</label>
                        <input type="text" class="form-control" name="author" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="lang">Мова книги</label>
                        <input type="text" class="form-control" name="lang" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="year">Рік видання</label>
                        <input type="number" min="1900" max="2016" class="form-control" name="year">
                    </div>
                    <div class="form-group">
                        <input type="file" id="inputFile4" name="photo" accept="image/*">
                        <div class="input-group">
                            <input type="text" readonly="" class="form-control" placeholder="Завантажити фото розміром до 2 Мб">
      <span class="input-group-btn input-group-sm">
        <button type="button" class="btn btn-fab btn-fab-mini">
            <i class="material-icons">attach_file</i>
        </button>
      </span>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label" for="description">Опис книги</label>
                        <textarea rows="5" name="description" class="form-control" id="description" maxlength="800"></textarea>
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
                    <input type="submit" class="btn btn-raised btn-primary" id="submit">
                </fieldset>
            </form>
        </div>
@stop

@section('js')
    $('#usr').val(user_id);
@stop