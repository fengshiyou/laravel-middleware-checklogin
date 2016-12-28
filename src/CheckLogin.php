<?php
namespace Union\MidCheckLogin;

use Predis;

class CheckLogin
{
    public static function test()
    {
        $server = array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'database' => 15
        );
        $client = new Predis\Client($server);
        $client->set('foo', 'bar');
        $value = $client->get('foo');

//        $z = $redis->set('z','20');
        var_dump($value);
    }
}
