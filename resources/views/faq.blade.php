<!DOCTYPE html>
<html lang=uk-UA>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Сайт для обміну книгами.">
    <meta name="keywords" content="Бар, буккросинг, Bookcrossing, книги">
    <meta name="author" content="Актив.БАР">
    <title>Буккросинг Бар</title>

    <!-- Bootstrap -->
    <link rel="shortcut icon" href="favicon.png"/>
    <!-- Material Design fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/bootstrap-material-design.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/ripples.min.css" rel="stylesheet">
    <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
    <script type="text/javascript">
        VK.init({apiId: 5233674, onlyWidgets: true});
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href=http://getbootstrap.com/assets/css/docs.min.css rel=stylesheet>
</head>
<body>
<div class="container bs-docs-container">
    <div class="jumbotron" style="background-color: #009688; padding: 0">
        <div class="row">
            <div class=" col-xs-12 col-lg-8 col-lg-offset-2">
                <img style="width:100%" alt="Буккросинг" src="images/jumbo.png">
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href='/'>Вільні книжки</a></li>
                    <li><a href='/notifications'>Сповіщення</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Мій кабінет<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/takenBook">Взята книга</a></li>
                            <li><a href="/myBooks">Мої книги</a></li>
                            <li><a href='/addBook'>Додати книгу</a></li>
                        </ul>
                    </li>
                    <li><a href="/history">Історія книгообігу</a></li>
                    <li class='active'><a href="#">FAQ</a></li>
                    <li><a href='/recommendations'>Рекомендації</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class=row>
        <div class=col-md-3 role=complementary>
            <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">
                <ul class="nav bs-docs-sidenav">
                    <li> <a href=#мета>Для чого?</a></li>
                    <li> <a href=#безпека>Це безпечно?</a></li>
                    <li> <a href=#мануал>Як користуватися?</a></li>
                    <li> <a href=#проблема>Я помітив помилку</a></li>
                    <li> <a href=#далі>Що далі?</a></li>
                    <li> <a href=#допомога>Як допомогти проекту?</a></li>
                </ul>
                <a class=back-to-top href=#top>Нагору</a>
                <div>
                    <button type="button" class="btn btn-primary" onclick="out()">Розлогінитись</button>
                </div>
                @yield('like')
                <div style="padding: 5px" id="vk_groups" class="center-block"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {
                        mode: 0,
                        width: "200",
                        height: "300",
                        color1: 'FFFFFF',
                        color2: '2B587A',
                        color3: '5B7FA6'
                    }, 96921760);
                </script>
            </nav>

        </div>
        <div class=col-md-9 role=main>
            <div class=bs-docs-section>
                <h1 id=мета class=page-header>Для чого?</h1>
                <p class=lead>Цей сайт створено для того, щоб ти міг легко обмінюватися книгами з іншими жителями нашого міста. Ми б дуже хотіли, щоб це стало для тебе стимулом читати більше. Ну і погодься, обмін книгами - непоганий привід для знайомства!</p>
            </div>
            <div class=bs-docs-section>
                <h1 id=безпека class=page-header>Це безпечно?</h1>
                <p class=lead>Ти легко можеш відслідкувати, у кого зараз знаходиться твоя книга.
                    Ти в будь який час можеш вимагати повернути книгу тобі.
                    Але ми не можемо гарантувати цілковитої надійності.
                    Тому добре дивися, кому даєш книгу. Якщо ж у тебе виникнуть проблеми з іншими користувачами сайту, то звертайся до адміністрації сайту - і будемо вирішувати цю проблему)</p>
            </div>
            <div class=bs-docs-section>
                <h1 id=мануал class=page-header>Як користуватися?</h1>
                <p class=lead>У розділі "Вільні книжки" ти бачиш всі книги в книгооберті і можеш вибрати книгу. Щоб подати заявку на отримання книги, натисни "Детальніше" -> "Взяти книгу".<br/>
                    В розділі "Сповіщення" ти побачиш повідомлення про свою діяльність та діяльність інших користувачів, направлену на твої книги.<br/>
                    В "Кабінеті" ти можеш додати книгу в книгообіг, маніпулювати власними книгами та повернути в книгообіг книгу, яку брав почитати.<br/>
                    В "Історії книгообігу" можна переглянути передачу книжок усіма користувачами сайту.<br/>
                    А у розділі "Рекомендації" ти побачиш книги, які можна взяти в Барській дитячій бібліотеці.</p>
            </div>
            <div class=bs-docs-section>
                <h1 id=проблема class=page-header>Я помітив помилку</h1>
                <p class=lead>Якщо ти побачив помилку у тексті, то виділи її та натисни <kbd>Ctrl+Enter</kbd>.<br/>
                    Якщо ж ти зіткнувся з неправильною роботою сайту, то повідом якнайшвидше <a target="_blank" href="https://vk.com/id99296865">мені</a>.<br/>
                    Ми сподіваємося на твою допомогу! Зробимо цей ресурс кращим разом!</p>
            </div>
            <div class=bs-docs-section>
                <h1 id=далі class=page-header>Що далі?</h1>
                <p class=lead>Якщо вам сподобається проект, то він буде і в подальшому розвиватися. Ось які поки що є плани:</p>
                <ul>
                    <li>Додати більше типів сповіщень</li>
                    <li>Додати рейтинг книги</li>
                    <li>Фільтр за користувачами та книгами у "Історії книгообігу"</li>
                    <li>Пошук книги за назвою та автором</li>
                    <li>Фільтрація книг за мовою</li>
                    <li>Додаток на Android</li>
                    <li>Сповіщення в браузері</li>
                    <li>Чорний список</li>
                    <li>Адмін-панель</li>
                    <li>Вихід на всеукраїнський рівень</li>
                    <li>Вихід на всесвітній рівень (ідеалу немає меж)</li>
                </ul>
                <p class="lead">Маєш гарну ідею для проекту? Розкажи про неї <a target="_blank" href="https://vk.com/id99296865">мені</a>!
                </p>
            </div>
            <div class=bs-docs-section>
                <h1 id=допомога class=page-header>Як допомогти проекту?</h1>
                <p class=lead>Найкраще, що ти можеш для нас зробити - це користуватися сайтом, читати книги та ставати розумнішим. Також було б непогано, якби ти розповів про цей ресурс друзям.<br/>
                    Але якщо почуття вдячності дуже сильне, то ти можеш допомогти матеріально, тим більше, що за хостинг потрібно платити. Ось номер рахунку:<br/><code>4790 7000 0707 0296</code>.</p>
            </div>
        </div>
    </div>
    <footer>
        <p class="pull-right"><a href="#top">Піднятись вгору</a></p>
        <a class="pull-right" href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="/js/orphus.gif" width="80" height="15" /></a>
        <p>© 2015-2016 {{ $version or "" }}</p>
        <div id="vk_subscribe"></div>
        <div id="vk_subscribe2"></div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/js/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/js/ripples.js"></script>
<script type="text/javascript" src="/js/orphus.js"></script>
<script>
    $.material.init();
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function out(){
        VK.Auth.logout();
        document.location.replace("/logout");
    }
    @yield('javascript')
    $(window).load(function () {
                VK.Widgets.Subscribe("vk_subscribe", {mode: 2}, -96921760);
                VK.Widgets.Subscribe("vk_subscribe2", {mode: 2}, 99296865);
            });
</script>
<script src=http://getbootstrap.com/assets/js/docs.min.js></script>

</body></html>