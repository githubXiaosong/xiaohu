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

                .state('question',{
                    abstract:true,
                    url:'/question',
                    template:'<div ui-view></div>' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })

                .state('question.add',{
                    url:'/add',//这里的/不是相对根目录而是相对上一层
                    templateUrl:'question.add.tpl' //先在页面的script中寻找这个页面 若没有则像服务器端申请页面
                })


        }])

    .service('UserService',[
        '$http',
        '$state',
        function($http,$state){//是在service中注入而不是在下面的函数中注入
            var me=this;//这里this代表自己(User)
            me.signup=function()
            {
                //me.signup_data={}; //也可以不指定 在页面的ne-model直接调用的时候 直接被创建 就算是递归的也会创建
                //console.log('sadasd');
                $http.post('/laravel/xiaohu/public/api/user'
                    ,me.signup_data)
                    .then(function(r){
                        if(r.data.status) {
                            $state.go('login');
                        }
                        me.signup_data={};
                    },function(e){
                        console.log(e);
                    })


            }
            me.username_exists=function()
            {
                $http.post('/laravel/xiaohu/public/api/user/exists'
                    ,{username:me.signup_data.username})
                    .then(function(r){
                       //suc
                        if(r.data.data.exists)
                            me.signup_username_exists=true;
                            //console.log('true');
                        else{
                            me.signup_username_exists=false;
                            //console.log('false');
                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }
            me.login=function()
            {
                $http.post('/laravel/xiaohu/public/api/login'
                    ,me.login_data)
                    .then(function(r){
                        if(r.data.status) {
                            $state.go('home');
                            me.login_data={};
                        }else{
                            me.validateError=true;
                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }

        }
    ])

    .service('QuestionService',[
        '$http',
        '$state',
        function($http,$state){
            var me=this;
            add_data={};
            me.go_add_question=function(){
                $state.go('question.add');
            }
            me.add_question=function()
            {
                $http.post('/laravel/xiaohu/public/api/question/add'
                    ,me.add_data)
                    .then(function(r){
                        console.log(r);
                        if(r.data.status) {
                            me.add_data={};
                            $state.go('home');
                        }else{

                        }
                    }
                    ,function(e){
                        //fail
                        console.log(e);
                    })
            }
        }
    ])

    .service('TimelineService',[
        '$http',
        function ($http) {
            var me=this;
            me.data=[];
            me.currentPage=1;
            me.isBusy=false;
            me.noMore=false;
            me.getData= function () {
                if(me.isBusy==true)
                    return;
                me.isBusy=true;

                if(me.noMore==true)
                    return;
                $http.post('/laravel/xiaohu/public/api/timeline'
                    ,{'page':me.currentPage}
                )
                    .then(function (r) {
                       if(r.status) {
                           if(r.data.data.length == 0)
                                me.noMore=true;
                           me.data = me.data.concat(r.data.data);
                           me.currentPage++;
                           console.log(me.data);
                       }
                        else
                            console.log('Server Error');
                    }, function (e) {
                        console.log(e);
                    }).finally(function () {
                        me.isBusy=false;
                    })
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
            $scope.$watch(
                function(){
                //应该返回要监听的数据模型  最好直接写要要监听数据 不要写外层的数据
                    return UserService.signup_data;
                }
                ,function(n,o){
                //发生变化的时候要做什么  n o为新旧数据模型的注入
                    UserService.username_exists();
                },true)//是否递归监控数据模型中的所有数据
        }

    ])
    //.service('UserService',function(){    以这个方式若在function中注入参数的时候会有一些问题 就是在上传到服务器进行和压缩的时候变量名会改变所以angluar会不认识
    //
    //});
    .controller('LoginController',[
        '$scope',
        'UserService',
        function($scope,UserService)
        {
            $scope.User=UserService;

        }
    ])

    .controller('QuestionController',[
        '$scope',
        'QuestionService',
        function($scope,QuestionService)
        {
            $scope.Question=QuestionService;
        }
    ])

    .controller('HomeController',[
        '$scope',
        'TimelineService',
        function ($scope,TimelineService) {
            var $win;
            $scope.Timeline=TimelineService;
            TimelineService.getData();

            $win=$(window);
            $win.on('scroll', function () {
                if( ($win.scrollTop() - ( $(document).height() - $win.height() ) )  > -5 ){
                    TimelineService.getData();
                }
            })
        }
    ])


