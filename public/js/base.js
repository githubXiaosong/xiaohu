angular.module('xiaohu',['ui.router'])


    .config([
        '$interpolateProvider',
        '$stateProvider',
        '$urlRouterProvider',
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
        }])

    .service('UserService',[
        function(){
            var me=this;//这里this代表自己(User)
            me.signup=function(){
                me.signup_data={}; //也可以不指定 在页面的ne-model直接调用的时候 直接被创建 就算是递归的也会创建
                console.log(me.signup_data.username);
            }
        }
    ])
    .controller('SignupController',[
        '$scope',
        'UserService',//xxxService不带$
        function($scope,UserService)
        {
            //因为直接在页面中找任何Service都是找不到的 但是在js文件都是相互可见的 只有绑定到对应的controller的scope下面才能在页面中使用
            $scope.User=UserService;
        }
    ])
    //.service('UserService',function(){    以这个方式若在function中注入参数的时候会有一些问题 就是在上传到服务器进行和压缩的时候变量名会改变所以angluar会不认识
    //
    //});


