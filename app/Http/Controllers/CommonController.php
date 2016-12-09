<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommonController extends Controller
{

    /* 时间线API */
    public function timeLine()
    {
        $l=get_limit_and_skip();

//        这个orderBy limit skip 配合方法就是从数据库中批量取数据的
        $questions= quesins()->orderBy('created_at','desc')
            ->with('user')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        $answers= answerins()->orderBy('created_at','desc')
            ->with('user')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        $data=$questions->merge($answers);
        $data->sortByDesc(function($item){
            return $item->created_at;
        });

        return ['status'=>1,'data'=>$data];
    }
}
