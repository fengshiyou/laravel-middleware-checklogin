<?php
namespace laravel\MidCheckLogin;
use Illuminate\Support\Facades\Redis;
use Union\Mid\BaseMiddleware;

class CheckLoginMiddleware extends BaseMiddleware
{
    protected function match($request)
    {
        $redis_conf = union_config('union.mid.checkLogin.redis',[]);
        $name_param = union_config('union.mid.checkLogin.name_param',[]);
        $token_param = union_config('union.mid.checkLogin.token_param',[]);
        $token_prefix = union_config('union.mid.checkLogin.token_prefix',[]);

        $redis = Redis::connection($redis_conf);

        $inputs = request()->all();

        if (array_key_exists($name_param,$inputs) && array_key_exists($token_param,$inputs)){
            $uid = $token_prefix.$inputs[$name_param];
            $token = $inputs[$token_param];
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
