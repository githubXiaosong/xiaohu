<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommonController extends Controller
{

    /* 时间线API */
    public function timeLine()
    {
        $l=get_limit_and_skip(5);

//        这个orderBy limit skip 配合方法就是从数据库中批量取数据的
//        问题和答案没有串联起来


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
            $que=$quesins->where(['id'=>$ans->question_id])->first();
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
}
