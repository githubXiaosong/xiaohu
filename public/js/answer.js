angular.module('answer',[])
    .service('AnswerService',[
         '$http',
         function ($http) {
             var his={
                 id:$('html').attr('user-id')
             }




             var me=this;
             /**
              * 提取answer数据中的vote
              * @param answer
              * @returns {Array} vote的键值对
              */
             me.getVote = function (answer) {
                 var data=[];
                 var timesUp=0;
                 var timesDown=0;
                for(var key in answer.users)
                {


                    if(answer.users[key].pivot.vote==1) {
                        timesUp++;

                        if(answer.users[key].pivot.user_id==his.id)
                        {
                                answer.hasUp=true;
                        }
                    }
                    if(answer.users[key].pivot.vote==2) {
                        timesDown++;

                        if(answer.users[key].pivot.user_id==his.id)
                        {
                                 answer.hasDown=true;
                        }
                    }

                }
                 data['timesUp']=timesUp;
                 data['timesDown']=timesDown;

                return data;
            }
             /**
              *  传入vote 调用服务器接口 并且更新页面
              * @param vote,answer_id
              * @returns {number}  成功返回0 失败返回-1
              */
             me.setVote = function (vote,answer_id,data) {

                 /**
                  * 先执行逻辑若返回结果不是1 怎反执行逻辑
                  */
                 for(var key in data)
                 {
                     if(data[key].answer.id==answer_id)
                     {
                         if(vote==1) {
                             data[key].answer.hasUp=true;
                             data[key].answer.hasDown=false;
                             data[key]['upVote']++;
                             data[key]['downVote']--;
                         }
                         if(vote==2) {
                             data[key].answer.hasUp=false;
                             data[key].answer.hasDown=true;
                             data[key]['upVote']--;
                             data[key]['downVote']++;
                         }
                         break;
                     }
                 }

                 $http.post('/laravel/xiaohu/public/api/answer/vote'
                     ,{'vote':vote,'id':answer_id}
                 ).then(
                     function (r) {
                         /**
                          *
                          */
                        if(r.data.status!=1){
                            /**
                             * 若逻辑返回值不是1怎反执行逻辑
                             */
                            for(var key in data)
                            {
                                if(data[key].answer.id==answer_id)
                                {
                                    if(vote==1) {
                                        data[key].answer.hasUp=false;
                                        data[key].answer.hasDown=true;
                                        data[key]['upVote']--;
                                        data[key]['downVote']++;
                                    }
                                    if(vote==2) {
                                        data[key].answer.hasUp=true;
                                        data[key].answer.hasDown=false;
                                        data[key]['upVote']++;
                                        data[key]['downVote']--;
                                    }
                                    break;
                                }
                            }
                            console.log(r);
                            return data;
                        }else if(r.data.status==1){
                            console.log(r);
                        }
                     },
                     function (e) {
                         console.log(e);
                     }
                 ).finally(function () {

                     })

                 return 0;
             }


        }
    ]);
