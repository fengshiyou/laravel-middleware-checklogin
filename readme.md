# laravel-middlware-checklogin

laravel开发 常用中间件

1. 登陆验证:通过登录名(uid)和登陆口令(token)验证
2. 登陆口令从redis中取
3. post/get 获取到的登录名和验证口令的变量名可配置
4. 使用具体的redis库名可配置
5. composer依赖包 "laravel-dev-common/union-middleware"和"laravel-dev-common/union-config"

### 使用示例

配置:

config/union.php

````
<?php

return [
    'mid'=>[
        'checkLogin'=>[
            'redis'=>'default',//redis库，./app/config/database中redis配置中取值
            'user_name'=>'uid',//用户登陆名
            'user_token'=>'token',//用户登陆token
        ]
    ]
];

````

Kernel.php

登陆验证
```

<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
       \laravel\MidCheckLogin\CheckLoginMiddleware::class,
    ];
    protected $routeMiddleware = [
    ];
}

```
composer.json

composer依赖包
```
"require": {
        "laravel-dev-common/union-middleware":"*",
        "laravel-dev-common/union-config":"*",
    },
```
