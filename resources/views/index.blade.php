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
                <form ng-controller="QuestionController" id="topForm" ng-submit="Question.go_add_question()">
                    <input class="" type="text" ng-model="Question.add_data.title">
                    <button type="submit">提问</button>
                </form>
            </div>
        </div>

        <div class="fr">

            <a class="navbar-item" href="#home">首页</a>
            @if(!isLogin())
                <a class="navbar-item" href="#login">登录</a>
                <a class="navbar-item" href="#signup">注册</a>
            @else
                <a class="navbar-item">{{ session('username') }}</a>
                <a class="navbar-item" href="{{url('api/logout')}}">登出</a>
            @endif
        </div>
    </div>
    {{-- ui-view 指令对应template中的内容 --}}
    <div class="page">
        <div ui-view/>
    </div>
</body>



{{--.page .home--}}
<script type="text/ng-template" id="home.tpl" >
    <div class="home container" >
        首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页首页
    </div>
</script>

{{--.page .login--}}
<script type="text/ng-template" id="login.tpl" >
    <div class="login container" ng-controller="LoginController">

        <div class="card">
            <h1>登录</h1>
            [: User.login_data :]
            {{--因为signupdata是在User中的 所以用的话需要用User.signupdata--}}
            <form ng-submit="User.login()" name="login_form">
                <div>
                    <label>用户名</label>
                    <input
                            ng-model="User.login_data.username"
                            ng-model-options="{debounce:500}"
                            type="text"
                            name="username"
                            ng-minlength="4"
                            ng-maxlength="16"
                            required
                            >
                </div>
                <div>
                    <label>密码</label>
                    <input
                            ng-model="User.login_data.password"
                            type="password"
                            name="password"
                            ng-minlength="6"
                            ng-maxlength="16"
                            required
                            >
                    <div class="input-err-set" >
                        <label ng-if="User.validateError">用户名或密码错误</label>
                    </div>
                </div>

                <button
                        type="submit"
                        ng-disabled="login_form.$invalid"
                        > 提交</button>
            </form>
        </div>


    </div>
</script>

{{--.page .signup--}}
<script type="text/ng-template" id="signup.tpl" >
    <div class="signup container" ng-controller="SignupController">
        <div class="card">
            <h1>注册</h1>
            [: User.signup_data :]
            {{--因为signupdata是在User中的 所以用的话需要用User.signupdata--}}
            <form ng-submit="User.signup()" name="signup_form">
                <div>
                    <label>用户名</label>
                    <input
                            ng-model="User.signup_data.username"
                            ng-model-options="{debounce:500}"
                            type="text"
                            name="username"
                            ng-minlength="4"
                            ng-maxlength="16"
                            required
                            >
                    <div class="input-err-set" ng-if="signup_form.username.$touched">
                        <label ng-if="User.signup_username_exists">用户名已存在</label>
                        <label ng-if="signup_form.username.$error.required">用户名为必填</label>
                        <label ng-if="signup_form.username.$error.minlength || signup_form.username.$error.maxlength"> 用户名应在6-26位  </label>

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
                    <div class="input-err-set" ng-if="signup_form.password.$touched">
                        <label ng-if="signup_form.password.$error.required">密码名为必填</label>
                        <label ng-if="signup_form.password.$error.minlength || signup_form.password.$error.maxlength" >密码应在6-26位></label>
                    </div>
                </div>
                <button
                        type="submit"
                        ng-disabled="signup_form.$invalid || User.signup_username_exists"
                        > 提交</button>
            </form>
        </div>

    </div>
</script>

<script type="text/ng-template" id="question.add.tpl" >
    <div class="container" ng-controller="QuestionController">
        <div class="card">
            [: Question.add_data :]
            <h1>提问</h1>
            <form ng-submit="Question.add_question()" name="question_add_form">
                <div>
                    <label>问题</label>
                    <input
                            ng-model="Question.add_data.title"
                            type="text"
                            name="title"
                            ng-minlength="4"
                            ng-maxlength="26"
                            required
                            >
                    <div class="input-err-set" ng-if="signup_form.username.$touched">
                        <label ng-if="question_add_form.title.$error.required">此项为必填项</label>
                        <label ng-if="question_add_form.title.$error.minlength || signup_form.username.$error.maxlength"> 问题应在6-26位  </label>

                    </div>
                </div>

                <div>
                    <label>问题描述</label>
                    <textarea
                            ng-model="Question.add_data.desc"
                            type="text"
                            name="desc"

                            ></textarea>
                </div>
                <button
                        type="submit"
                        ng-disabled="question_add_form.$invalid"
                        > 提交</button>

            </form>
        </div>
    </div>
</script>

</html>