/**
 *
 * Created by Administrator on 2016/12/11.
 */
angular.module('common',['answer'])

    .service('TimelineService',[
        '$http',
        'AnswerService',

        /**
         *  点赞功能是不是不该这么做?应该的问题表中有个字段？？？
         * @param $http
         * @param AnswerService
         */
        function ($http,AnswerService) {
            var me=this;
            me.data=[];
            me.currentPage=1;
            me.isBusy=false;
            me.noMore=false;
            /**
             * 从服务器获取数据 新的交给answerService处理一下vote问题然后合并一下
             */
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
                            for(var key in r.data.data) {
                                /**
                                 * 传入新的数据answerService 给新的数据进行计算vote赋值 然后判断有没有投过票 来决定 按钮的状态
                                 * @type {Array}
                                 */
                                ret=AnswerService.getVote(r.data.data[key].answer);
                                r.data.data[key]['upVote']=ret['timesUp'];
                                r.data.data[key]['downVote']=ret['timesDown'];
                            }
                            me.data = me.data.concat(r.data.data);
                            me.currentPage++;
                            console.log(me.data);
                        }else
                            console.log('Server Error');
                    }, function (e) {
                        console.log(e);
                    }).finally(function () {
                        me.isBusy=false;
                    })
            }

            /**
             * 传入vote,answer_id 在之中更新data
             * @param vote,answer_id
             */
            me.setVote= function (vote,answer_id) {
                AnswerService.setVote(vote,answer_id,me.data);
            }
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


