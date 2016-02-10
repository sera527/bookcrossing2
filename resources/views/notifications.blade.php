<!DOCTYPE html>
<html lang="uk-UA">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Сайт для обміну книгами.">
    <meta name="keywords" content="Бар, буккросинг, Bookcrossing, книги">
    <meta name="author" content="Актив.БАР">
    <title>Буккросинг Бар</title>
    <link rel="shortcut icon" href="favicon.png"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/bootstrap-material-design.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/css/ripples.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script> <!-- Modernizr -->
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

<div id="main" style="background-color: #eee; color: #333" class="navbar navbar-default">

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
                    <li class='active'><a href='#'>Сповіщення</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Мій кабінет<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/takenBook">Взята книга</a></li>
                            <li><a href="/myBooks">Мої книги</a></li>
                            <li><a href='/addBook'>Додати книгу</a></li>
                        </ul>
                    </li>
                    <li><a href="/history">Історія книгообігу</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href='/recommendations'>Рекомендації</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    @if(count($notifications)>0)
    <div>
        <section id="cd-timeline" class="cd-container">
            @foreach($notifications as $notification)
                {!! $notification !!}
            @endforeach
        </section>
    </div>
    @endif
</div>
<hr>
<footer>
    <p class="pull-right"><a href="#">Піднятись вгору</a></p>
    <p>© 2015 {{ $version or ""}}</p>
    <div id="vk_subscribe"></div>
    <div id="vk_subscribe2"></div>
</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/js/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.7/js/ripples.js"></script>
<script src="js/main.js"></script>
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<script type="text/javascript">
    VK.init({
        apiId: 5177217
    });
    $(window).load(function () {
        VK.Widgets.Subscribe("vk_subscribe", {mode: 2}, -96921760);
        VK.Widgets.Subscribe("vk_subscribe2", {mode: 2}, 99296865);
    });
</script>
<script>
    $.material.init();
</script>
</body>
</html>