<?php


class RpcTest extends \PHPUnit_Framework_TestCase
{

    protected static $redis;


    public static function setUpBeforeClass()
    {
        self::$redis = new \Redis();
        self::$redis->connect('127.0.0.1', 6379);
        self::$redis->select(1);
        self::$redis->setOption(\Redis::OPT_PREFIX, 'RpcPhpTesting:');
        self::$redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_NONE);
    }

    public function testCreateMessage()
    {
        $queue = 'Youtube'; // microservice name
        $message = new \RpcPhp\Message($queue, 'getVideo', ['UCH8zwr3rJOcgCApR_5z31cw']);
        $json = $message->serialize();
        self::assertEquals('{"queue":"Youtube","fn":"getVideo","args":["UCH8zwr3rJOcgCApR_5z31cw"]}', $json);

        $message = new \RpcPhp\Message();
        $message->unserialize($json);
        self::assertEquals('{"queue":"Youtube","fn":"getVideo","args":["UCH8zwr3rJOcgCApR_5z31cw"]}', $message->serialize());
    }
}