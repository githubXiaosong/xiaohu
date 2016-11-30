 <?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*通用方法*/
function userins()
{
    return new App\User;
}
function quesins()
{
    return new App\Question;
}
function answerins()
{
    return new App\Answer;
}
function commentins()
{
    return new App\Comment;
}

function get_limit_and_skip($limit = null)//是不穿为空 而不是穿了null为空
{
    $limit=$limit?:15;
    return ['limit' => $limit, 'skip' => (rq('page') ? (rq('page') - 1) : 0) * $limit];
}



function rq($key=null)
{
    return ($key==null) ? Request::all() : Request::get($key);
}

function suc($data=null){

    $ram=['status'=>1];

    if($data)
    {
         $ram['data']=$data;

        return $ram;
    }
    return $ram;
}

function err($msg='error',$data=null){
    if($data)
        return array_merge(['status'=>2,'msg'=>$msg],$data);
    return ['status'=>0,'msg'=>$msg];
}



Route::group(['middleware'=>['web']],function(){//不开启web中间件是不能使用session的



    Route::get('/', function ()
    {
        return view('index');
    });


    Route::any('api/user',function(){
        return userins()->signup();
    });

    Route::any('api/login',function(){
        return userins()->login();
    });

    Route::any('api/logout',function(){
        return userins()->logout();
    });

    Route::any('api/user/changepassword',function(){
        return userins()->change_password();
    });

    Route::any('api/user/resetpasswordsend',function(){
        return userins()->resetPassword_send();
    });

    Route::any('api/user/resetpasswordvalidate',function(){
        return userins()->resetPassword_validate();
    });

    Route::any('api/user/getuserinfo',function(){
        return userins()->get_userInfo();
    });

    Route::any('api/question/add',function(){
        return quesins()->add();
    });

    Route::any('api/question/change',function(){
        return quesins()->change();
    });

    Route::any('api/question/read',function(){
        return quesins()->read();
    });

    Route::any('api/question/remove',function(){
        return quesins()->remove();
    });


    Route::any('api/answer/add',function(){
        return answerins()->add();
    });


    Route::any('api/answer/change',function(){
        return answerins()->change();
    });

    Route::any('api/answer/read',function(){
        return answerins()->read();
    });

    Route::any('api/answer/remove',function(){
        return answerins()->remove();
    });

    Route::any('api/answer/vote',function(){
        return answerins()->vote();
    });

    Route::any('api/comment/add',function(){
        return commentins()->add();
    });

    Route::any('api/comment/remove',function (){
       return commentins()->remove();
    });

    Route::any('api/comment/read',function (){
        return commentins()->read();
    });

    Route::any('api/timeline','CommonController@timeLine');

    Route::any('test',function(){
        dd(session()->all());
    });

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
