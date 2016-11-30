<!doctype html>
<html lang="zh" ng-app="xiaohu">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{--默认是从public目录开始的  /就是跟目录的--}}
    <link rel="stylesheet" href="lib/normalize/normalize.css">
    <link rel="stylesheet" href="css/base.css">
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/angular/angular.min.js"> </script>
    <script src="lib/angular-ui-route/release/angluar-ui-route.js"></script>
    <script src="js/base.js"></script>

</head>
<body>
    <div class="navbar clearfix">
        <div class="fl navbar-item">
            <div>
            <a class="navbar-item brand" href="#home">晓乎</a>
            <input class="" type="text">
            </div>
        </div>

        <div class="fr">
            <a class="navbar-item" href="#home">首页</a>
            <a class="navbar-item" href="#login">登录</a>
            <a class="navbar-item" href="#signup">注册</a>
        </div>
    </div>
    {{-- ui-view 指令对应template中的内容 --}}
    <div class="page">
        <div ui-view/>
    </div>
</body>



{{--.page .home--}}
<script type="text/ng-template" id="home.tpl" >
    <div class="home container">
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>
        <div>homehomehomehomehomehomehomehome</div>

    </div>
</script>

{{--.page .login--}}
<script type="text/ng-template" id="login.tpl" >
    <div class="login container">
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>
        <div>loginloginloginloginloginloginlogin</div>

    </div>
</script>

{{--.page .signup--}}
<script type="text/ng-template" id="signup.tpl" >
    <div class="signup container">
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>
        <div>signupsignupsignupsignupsignupsignup</div>

    </div>
</script>

</html>