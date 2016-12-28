<?php
namespace laravel\MidCheckLogin;
use Illuminate\Support\Facades\Redis;
use Union\Mid\BaseMiddleware;

class CheckLoginMiddleware extends BaseMiddleware
{
    protected function match($request)
    {
        $redis_conf = union_config('union.mid.checkLogin.redis',[]);
        $user_name_conf = union_config('union.mid.checkLogin.user_name',[]);
        $user_login_token = union_config('union.mid.checkLogin.user_token',[]);

        $redis = Redis::connection($redis_conf);

        $inputs = request()->all();

        if (array_key_exists($user_name_conf,$inputs) && array_key_exists($user_login_token,$inputs)){
            $uid = $inputs[$user_name_conf];
            $token = $inputs[$user_login_token];
        }else{
            return [
                "code" => 500,
                "detail" => "缺少参数",
                "data"=>[]
            ];
        }

        $redis_token = $redis->get($uid);
        if ($token == $redis_token){
            return '';
        }else{
            return [
                "code" => 500,
                "detail" => "请先登陆",
                "data"=>[]
            ];
        }
    }
}
