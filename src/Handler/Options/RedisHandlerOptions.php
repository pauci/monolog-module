<?php

namespace MonologModule\Handler\Options;

class RedisHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var \Predis\Client|\Redis|string
     */
    protected $redis;

    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $redis
     */
    public function setRedis($redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return \Predis\Client|\Redis|string
     */
    public function getRedis()
    {
        return $this->redis;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
