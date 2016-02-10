@extends('base')

@section('main')
    @if(session()->get('VKusr') == 114248472 ||session()->get('VKusr') == 99296865)
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Як додати пост
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <ul>
                        <li>Копіюєш посилання на пост. Наприклад, <code>https://vk.com/wall-45519268_345</code>.</li>
                        <li>Вставляєш його у відповідне місце на сторінці <a target="_blank" href="https://vk.com/dev/Post">vk.com/dev/Post</a>.</li>
                        <li>Копіюєш вміст поля "Код для вставки" і вставляєш його на цій сторінці нижче.</li>
                        <li>Перед відправкою форми не забудь видалити з коду це: <code>, {width: 665}</code>. Наприклад:
                            <pre>
&lt;div id="vk_post_1_45616"&gt;&lt;/div&gt;
&lt;script type="text/javascript"&gt;
    (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//vk.com/js/api/openapi.js?121"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'vk_openapi_js'));
    (function() {
        if (!window.VK || !VK.Widgets || !VK.Widgets.Post || !VK.Widgets.Post("vk_post_1_45616", 1, 45616, 'bsU4Zt9qowoYKcJfUcH6i6Ayfgw'<kbd>, {width: 665}</kbd>)) setTimeout(arguments.callee, 50);
    }());
&lt;/script&gt;
                            </pre>
                            Якщо ти не зробиш цього, то пост матиме фіксовану ширину і не зможе адаптуватися під різні розміри екранів.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="well bs-component">
    <form class="form-horizontal" method="get" action="/addPost">
        <fieldset>
            <div class="form-group">
                <label for="post">Додати запис:</label>
                <textarea rows="10" name="post" class="form-control"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input class="btn btn-raised btn-primary" type="submit">
        </fieldset>
    </form>
</div>
@else
    <p>Ти не маєш права на доступ до цієї сторінки. Як ти сюди взагалі потрапив?</p>
@endif
@stop