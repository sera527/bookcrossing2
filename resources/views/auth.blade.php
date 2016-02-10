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
    <title>Буккросинг Бар</title>

    <!-- Bootstrap -->
    <link rel="shortcut icon" href="favicon.png"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
</head>
<body style="background-color: #EEE;">
<div id="vk_api_transport"></div>
<script type="text/javascript">
    window.vkAsyncInit = function() {
        VK.init({
            apiId: 5233674
        });
    };

    setTimeout(function() {
        var el = document.createElement("script");
        el.type = "text/javascript";
        el.src = "//vk.com/js/api/openapi.js";
        el.async = true;
        document.getElementById("vk_api_transport").appendChild(el);
    }, 0);
</script>
    <div style="margin-top:20%">
        <button type="button" class="btn btn-lg btn-primary center-block" onclick="VK.Auth.login(authInfo);">Увійти Вконтакті</button>
    </div>
    <script type="text/javascript">
        function authInfo(response) {
            if (response.session) {
//                document.location.replace("/login?VKname="+response.session.mid);
                document.location.href = "/login?VKname="+response.session.mid;
            } else {
                alert('Для роботи з сайтом потрібно авторизуватися.');
            }
        }
    </script>
</body>
</html>