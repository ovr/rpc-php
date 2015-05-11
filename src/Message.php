<?php

namespace RpcPhp;

use InvalidArgumentException;

class Message implements \Serializable
{

    protected $queue;

    protected $fn;

    protected $args;


    /**
     * @param string $queue
     * @param string $fn
     * @param array  $args
     */
    public function __construct($queue = null, $fn = null, array $args = null)
    {
        if (func_num_args() > 0) {
            if ($queue && $fn && count($args)) {
                $this->id = uniqid($queue . getmypid(), true);
                $this->queue = $queue;
                $this->fn = $fn;
                $this->args = $args;
            } else {
                throw new InvalidArgumentException();
            }
        }
    }

    public function serialize()
    {
        return json_encode(['queue' => $this->queue, 'fn' => $this->fn, 'args' => $this->args]);
    }

    public function unserialize($serialized)
    {
        foreach (json_decode($serialized) as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getQueue()
    {
        return $this->queue;
    }
}
