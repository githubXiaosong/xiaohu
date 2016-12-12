/**
 * Created by Administrator on 2016/12/11.
 */

angular.module('question',[])


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

    .controller('QuestionController',[
        '$scope',
        'QuestionService',
        function($scope,QuestionService)
        {
            $scope.Question=QuestionService;
        }
    ])