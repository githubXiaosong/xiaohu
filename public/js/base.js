angular.module('xiaohu',['ui.router','user','question','common'])


    .config([
        '$interpolateProvider',
        '$stateProvider',
        '$urlRouterProvider',
        '$locationProvider',
        function($interpolateProvider
            ,$stateProvider
            ,$urlRouterProvider)
        {
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');

            $urlRouterProvider.otherwise('/home');

            $stateProvider
                .state('home',{
                    url:'/home',//指定在这个页面之后的路由和对应的在ui-view中的模板
                    templateUrl:'/laravel/xiaohu/public/tpl/page/home'
                })

                .state('login',{
                    url:'/login',
                    templateUrl:'/laravel/xiaohu/public/tpl/page/login' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('signup',{
                    url:'/signup',
                    templateUrl:'/laravel/xiaohu/public/tpl/page/signup' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('question',{
                    abstract:true,
                    url:'/question',
                    template:'<div ui-view></div>' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('question.add',{
                    url:'/add',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/question_add' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('user',{
                    url:'/user/:id',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'/laravel/xiaohu/public/tpl/page/user' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })


        }])





