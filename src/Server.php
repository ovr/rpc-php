<?php

namespace PhpRpc;

class Server
{

    /** @var \Redis */
    protected $redis;

    /** @var string */
    protected $queue;


    /**
     * @param \Redis $redis
     */
    public function __construct(\Redis $redis, $queue)
    {
        $prefix = $redis->getOption(\Redis::OPT_PREFIX);
        if (strpos($prefix, ':rpc:') === false) {
            $redis->setOption(\Redis::OPT_PREFIX, trim($prefix, ':') . ':rpc:');
        }
        $this->redis = $redis;
        $this->queue = $queue;
    }

    public function start($worker)
    {
        //$this->redis->del($this->queue);
        //$timeout = 1;
        //while (1) {
        //    $res = $this->redis->blpop($this->queue, $timeout);
        //    if (count($res)) {
        //        list($queue, $data) = $res;
        //        $message = new Message();
        //        $message->unserialize($data);
        //        $res = $worker($message);
        //    }
        //}
    }
}

