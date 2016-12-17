/**
 *
 *
 * Created by Administrator on 2016/12/17.
 */

angular.module('test',[])

    .controller('testController',[
        '$scope',
        function ($scope) {
            $scope.loadData= function () {
                console.log('正在加载数据...');
            }
        }
    ])


    .controller('test2Controller',[
        '$scope',
        function ($scope) {
            $scope.loadData2= function () {
                console.log('正在加载数据...2');
            }
        }
    ])




    .directive('hello', function () {
        return {
            restrict: "AE",
            transclude:true,
            templateUrl: '/laravel/xiaohu/public/test/directive/hello.html',
            link : function(scope,element,attr){
                /**
                 * 在dom中绑定事件  绑定作用域
                 */
                element.bind('mouseenter', function () {
                    scope.$apply(attr.howtoload);
                })

            }

        }
    })

    .directive('superman', function () {
        return {
            /**
             * 创建独立的作用域
             */
            scope: {},
            restrict: 'AE',
            /**
             *controller 方法为了给外部暴露出一组可以调用的公共方法
             */
            controller: function ($scope) {
                $scope.abilities = [];
                this.addStrength= function () {
                    $scope.abilities.push('strength');
                };
                this.addSpeed= function () {
                    $scope.abilities.push('speed');
                };
                this.addLight= function () {
                    $scope.abilities.push('light');
                };

            },
            link: function(scope,element,attr){
                /**
                 * 内置了 jq 的语法
                 *
                 * link 是用来处理指令内部的事物的
                 * 如果想要给指令暴露出一些方法给外部去调用 就要写在 controller之中
                 */
                element.addClass('btn btn-primary');
                element.bind('mouseenter', function () {
                    console.log(scope.abilities);
                })
            }
        }
    })

    .directive('strength', function () {
        return {
            /**
             * require 指明依赖的指令  写了这个就可以写 第四个参数
             */
            require :'^superman',
            link: function(scope,element,attr,supermanCtrl){
                supermanCtrl.addStrength();
            }
        }
    })

    .directive('speed', function () {
        return {
            require :'^superman',
            link: function(scope,element,attr,supermanCtrl){
                supermanCtrl.addSpeed();
            }
        }
    })

    .directive('light', function () {
        return {
            require :'^superman',
            link: function(scope,element,attr,supermanCtrl){
                supermanCtrl.addLight();
            }
        }
    })

    .directive('inputtest', function () {
        return {
            scope:{},
            templateUrl:'/laravel/xiaohu/public/test/directive/inputtest.html'
        }
    })

    .controller('ctrl1',[
        '$scope',
        function ($scope) {
            $scope.flaveor='百威';
        }
    ])

    .directive('drink', function () {
        return {
            scope:{
                flaveor:'@'
            },
            template:'<div>{{ flaveor }}</div>',
            link: function (scope,element,attr) {
               //scope.flaveor=attr.flaveor;
            }
        }
    })

    .directive('drink1', function () {
        return {
            scope:{
                flaveor:'='
            },
            template:'<div><input type="text" ng-model="flaveor"></div>'
        }
    })

    .controller('ctrl2',[
        '$scope',
        function ($scope) {
            $scope.sayHello= function (name) {
                alert('hello'+name);
            }
        }
    ])

    .directive('greeting', function () {
        /**
         * 绑定完成后直接就是一个方法了可以直接调用了
         */
        return {
            scope:{
                greet:'&'
            },
            template:'<input type="text" ng-model="username"> <button ng-click="greet({ name:username })">0.0</button>'
        }
    })





