<?php

namespace PhpRpc;

class Client
{

    protected $redis;

    /**
     * @param \Redis $redis
     */
    public function __construct(\Redis $redis)
    {
        $prefix = $redis->getOption(\Redis::OPT_PREFIX);
        if (strpos($prefix, ':rpc:') === false) {
            $redis->setOption(\Redis::OPT_PREFIX, trim($prefix, ':') . ':rpc:');
        }
        $this->redis = $redis;
    }

    /**
     * @param Message $message
     * @param int     $retryCount
     * @return SyncResponse
     */
    public function execute(Message $message, $retryCount = 2)
    {
        $key = 'sync:' . $message->getQueue();
    }

    /**
     * @param Message $message
     * @param int     $retryCount
     * @return int
     */
    public function push(Message $message, $retryCount = 2)
    {
        $key = 'async:' . $message->getQueue();
        $data = $message->serialize();
        $result = $this->redis->rpush($key, $data);
        if ($result === false) {
            //throw new TimeoutException(); todo
        }

        return $result;
    }

    /**
     * @param Message $message
     * @param int     $retryCount
     * @internal param int $attempts
     */
    public function publish(Message $message, $retryCount = 2)
    {
        $key = 'stream:' . $message->getQueue();
    }
}
