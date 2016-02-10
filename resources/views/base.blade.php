<!DOCTYPE html>
<html lang="uk-UA">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Сайт для обміну книгами.">
    <meta name="keywords" content="Бар, буккросинг, Bookcrossing, книги">
    <meta name="author" content="Актив.БАР">
    <meta http-equiv="refresh" content="3600">
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
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NF6RMN"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NF6RMN');</script>
<!-- End Google Tag Manager -->
<div class="container">
    <div class="jumbotron" style="background-color: #009688; padding: 0">
        <div class="row">
            <div class=" col-xs-12 col-lg-8 col-lg-offset-2">
                <img style="width:100%" alt="Буккросинг" src="images/jumbo.png">
            </div>
        </div>
    </div>

    <div class="row">

        <div id="main" style="background-color: #eee; color: #333" class="col-lg-9 navbar navbar-default">

            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand hidden-md hidden-lg" href="/notifications">
                            @if(isset($countNot)&&$countNot>0)
                                Сповіщення: <span class="badge">{{ $countNot }}</span>
                            @else
                                Нових сповіщень немає
                            @endif</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li @yield('active1')><a href="/">Вільні книжки</a></li>
                            <li @yield('active3')><a href='/notifications'>Сповіщення
                                        @if(isset($countNot)&&$countNot>0)
                                        <span class="badge">{{ $countNot }}</span>
                                        @endif
                                </a></li>
                            <li class="@yield('active9') dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Мій кабінет<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li @yield('active8')><a href='/takenBook'>Взята книга</a></li>
                                    <li @yield('active4')><a href='/myBooks'>Мої книги</a></li>
                                    <li @yield('active2')><a href='/addBook'>Додати книгу</a></li>
                                </ul>
                            </li>
                            <li @yield('active5')><a href='/history'>Історія книгообігу</a></li>
                            <li @yield('active10')><a href='/faq'>FAQ</a></li>
                            <li @yield('active7')><a href='/recommendations'>Рекомендації</a></li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    @yield('main')
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <button type="button" class="btn btn-primary" onclick="out()">Розлогінитись</button>
            </div>
            @yield('like')
            <div style="padding: 5px" id="vk_groups" class="center-block"></div>
            <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {
                    mode: 0,
                    width: "220",
                    height: "400",
                    color1: 'FFFFFF',
                    color2: '2B587A',
                    color3: '5B7FA6'
                }, 96921760);
            </script>
        </div>
    </div>
    <hr>
    <footer>
        <p class="pull-right"><a href="#">Піднятись вгору</a></p>
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
</body>
</html>