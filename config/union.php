<?php

return [
    'mid'=>[
        'checkLogin'=>[
            'redis'=>'default',//config('database')
            'token_prefix'=>'tk',//redis中用于token的前缀
            'name_param'=>'uid',//用户登陆名
            'token_param'=>'token',//用户登陆token
        ]
    ]
];
