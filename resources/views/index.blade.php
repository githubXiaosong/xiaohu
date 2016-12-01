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
    <div class="home container" ng-controller="SignupController">
        <div class="card">
            <h1>注册</h1>
            [: User.signup_data :]
            {{--因为signupdata是在User中的 所以用的话需要用User.signupdata--}}
            <form ng-submit="User.signup()" name="signup_form">
                <div>
                    <label>用户名</label>
                    <input
                            ng-model="User.signup_data.username"
                            type="text"
                            name="username"
                            ng-minlength="4"
                            ng-maxlength="16"
                            required
                            >
                    <div class="input-err-set">
                        <div ng-if="signup_form.username.$error.required">用户名为必填</div>
                        <div ng-if="signup_form.username.$error.minlength">用户名为过短</div>
                        <div ng-if="signup_form.username.$error.maxlength">用户名为过长</div>
                    </div>
                </div>
                <div>
                    <label>密码</label>
                    <input
                            ng-model="User.signup_data.password"
                            type="password"
                            name="password"
                            ng-minlength="6"
                            ng-maxlength="16"
                            required
                            >
                    <div class="input-err-set">
                        <div ng-if="signup_form.password.$error.required">密码名为必填</div>
                        <div ng-if="signup_form.password.$error.minlength">密码名为过短</div>
                        <div ng-if="signup_form.password.$error.maxlength">密码名为过长</div>
                    </div>
                </div>
                    <input
                            type="submit"
                            ng-disabled="signup_form.$invalid"
                            >
            </form>
        </div>
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