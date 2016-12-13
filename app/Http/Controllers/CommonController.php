<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommonController extends Controller
{
    /*
     * 宗旨上 后端应该是给前端来体统服务的 应该吧稍微复杂一点的逻辑就写到controller之中
     * 而不是在model之中 在前端的一个页面中的一次操作应该只发送一个请求
     * 后端的controller应该充分的配合前端的页面显示
     */


    /** 时间线API
     * @ page
     * @权限 ALL
     * @return array
     */
    public function timeLine()
    {

        $l=get_limit_and_skip(5);

        /**
         *这个orderBy limit skip 配合方法就是从数据库中批量取数据的
         *问题和答案没有串联起来
         */



        $data= [];
        $answers= answerins()->orderBy('created_at','desc')
            ->with('user')
            ->with('users')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        $quesins=quesins();
        $comment=commentins();
        $item=[];
        foreach($answers as $ans)
        {
            $que=$quesins->where(['id'=>$ans->question_id])->first

            ();
            $com=$comment->where(['answer_id'=>$ans->id])
                ->with('user')
                ->get();
            $item['question']=$que;
            $item['answer']=$ans;
            $item['comment']=$com;
            $data[]=$item;

        }

//        dd($data);
        return ['status'=>1,'data'=>$data];
    }


    /** 用户详情API
     * @取得用户的ID 和 page
     * @权限  ALL
     * @return array
     */
    public function userDetails()
    {

        $l=get_limit_and_skip(5);

        if(!rq('id'))
            return err('that is not id(user)');

        $get=['id','username','avatar_url','email','phone'];
        $user=userins()->find(rq('id'),$get);
        if(!$user)
            return err('no that user');

        /**
         * 用户的提的问题
         */
        $questions=quesins()
            ->orderBy('created_at','desc')
            ->where(['user_id'=>$user->id])
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        /**
         * 用户的回答
         */
        $answers=answerins()
            ->orderBy('created_at','desc')
            ->where(['user_id'=>$user->id])
            /**
             * 用户的回答所对应的问题
             */
            ->with('question')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        /**
         * 组合 返回
         */
        $data=[
            'user'=>$user,
            'questions'=>$questions,
            'answers'=>$answers
        ];


        return suc($data);
    }


    /**
     * 根据请求中的用户ID返回所对应的答案和所对应的问题
     * @return array
     */
    public function getUserAnswer()
    {
        if(! $this->isUserExists())
            return err('user_id or user not exit');

        $l=get_limit_and_skip(5);

        $answers=answerins()
            ->orderBy('created_at','desc')
            ->where(['user_id'=>rq('id')])
            ->with('question')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        return suc($answers);
    }

    /**
     * 根据用户ID返回所对对应的问题
     * @ array
     */
    public function getUserQuestion()
    {
        if(! $this->isUserExists())
            return err('user_id or user not exit');

        $l=get_limit_and_skip(5);

        $questions=quesins()
            ->orderBy('created_at','desc')
            ->where(['user_id'=>rq('id')])
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');
        return suc($questions);
    }

    /**
     * 工具方法:判断用户ID和用户是否存在
     *
     */
    public function isUserExists()
    {
        if(!rq('id'))
            return false;
        if( ! userins()->find(rq('id')) )
            return false;
        return true;
    }


    /**
     * 测试 API
     * @
     */

    public function test()
    {
        return test;
    }

}
