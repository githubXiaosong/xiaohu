angular.module('xiaohu',['ui.router'])

    .config(function($interpolateProvider
        ,$stateProvider
        ,$urlRouterProvider)
    {
        $interpolateProvider.startSymbol('[:');
        $interpolateProvider.endSymbol(':]');

        $urlRouterProvider.otherwise('/home');

        $stateProvider
            .state('home',{
                url:'/home',//指定在这个页面之后的路由和对应的在ui-view中的模板
                templateUrl:'home.tpl'
            })

            .state('login',{
                url:'/login',
                templateUrl:'login.tpl' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
            })

            .state('signup',{
                url:'/signup',
                templateUrl:'signup.tpl' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
            })
    })

