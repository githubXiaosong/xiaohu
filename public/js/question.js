/**
 * Created by Administrator on 2016/12/11.
 */

angular.module('question',[])


    .service('QuestionService',[
        '$http',
        '$state',
        'AnswerService',
        function($http,$state,AnswerService){
            var me=this;
            me.add_data={};
            me.question={};
            me.answers=[];
            me.go_add_question=function(){
                $state.go('question.add');
            }
            me.addQuestion=function()
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

            /**
             * 根据问题ID返回对应的问题
             */
            me.getQuestion= function ($params)
            {
                $http.post(
                    '/laravel/xiaohu/public/api/question/read',
                    $params
                ).then(
                    function ($r) {
                        if($r.data.status)
                            me.question = $r.data.data;
                        else {
                            console.log('Server Error');
                        }
                    },
                    function ($e) {
                        console.log($e);
                    }
                ).finally(
                    function () {

                    })
            }

            /**
             * 根据问题ID批量的返回对应的问题 回答者 和 点赞情况
             */
            me.getAnswersAndUserAndVote=function ($params)
            {
                $http.post(
                    '/laravel/xiaohu/public/api/getquestiondetails',
                    $params
                ).then(
                    function ($r) {
                        if($r.data.status) {
                            /**
                             * 数据需要进行处理然后添加
                             * 直接调用 AnswerService 进行处理然后返回就行了
                             */

                            for(var key in $r.data.data) {
                                 AnswerService.getVote($r.data.data[key]);
                                me.answers=me.answers.concat($r.data.data[key]);
                            }


                        } else
                            console.log('Server Error');
                    },
                    function ($e) {
                        console.log($e);
                    }
                ).finally(
                    function () {

                    })
            }

            me.setVote= function (vote,answer_id) {
                AnswerService.setVote(vote,answer_id,me.answers,
                    /**
                     * 四个业务逻辑回调函数
                     *
                     */
                    function (key) {
                        me.answers[key].hasUp=true;
                        me.answers[key].hasDown=false;
                        me.answers[key]['timesUp']++;
                        me.answers[key]['timesDown']--;
                    },
                    function (key) {
                        me.answers[key].hasUp=false;
                        me.answers[key].hasDown=true;
                        me.answers[key]['timesUp']--;
                        me.answers[key]['timesDown']++;
                    },
                    function (key) {
                        me.answers[key].hasUp=false;
                        me.answers[key].hasDown=true;
                        me.answers[key]['timesUp']--;
                        me.answers[key]['timesDown']++;
                    },
                    function (key) {
                        me.answers[key].hasUp=true;
                        me.answers[key].hasDown=false;
                        me.answers[key]['timesUp']++;
                        me.answers[key]['timesDown']--;
                    },
                    function (key) {
                        return me.answers[key].id;
                    }
                );
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

    .controller('QuestionAddController',[
        '$scope',
        function($scope)
        {

        }
    ])

    .controller('QuestionDetailsController',[
        '$scope',
        '$stateParams',
        function($scope,$stateParams)
        {
            /**
             * 载入页面发两个请求上去  然后监听下拉刷新只发第二个请求来更新数据
             */
            $scope.Question.getQuestion($stateParams)
            $scope.Question.getAnswersAndUserAndVote({'question_id':$stateParams.id});
        }
    ])