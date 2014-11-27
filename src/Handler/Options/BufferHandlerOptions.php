<?php

namespace MonologModule\Handler\Options;

class BufferHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var \Monolog\Handler\HandlerInterface|string
     */
    protected $handler;

    /**
     * @var int
     */
    protected $bufferLimit = 0;

    /**
     * @var bool
     */
    protected $flushOnOverflow = false;

    /**
     * @param int $bufferLimit
     */
    public function setBufferLimit($bufferLimit)
    {
        $this->bufferLimit = $bufferLimit;
    }

    /**
     * @param boolean $flushOnOverflow
     */
    public function setFlushOnOverflow($flushOnOverflow)
    {
        $this->flushOnOverflow = $flushOnOverflow;
    }

    /**
     * @param \Monolog\Handler\HandlerInterface|string $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return int
     */
    public function getBufferLimit()
    {
        return $this->bufferLimit;
    }

    /**
     * @return boolean
     */
    public function getFlushOnOverflow()
    {
        return $this->flushOnOverflow;
    }

    /**
     * @return \Monolog\Handler\HandlerInterface|string
     */
    public function getHandler()
    {
        return $this->handler;
    }
}
