<?php

namespace MonologModule\Handler\Options;

use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;
use Monolog\Handler\HandlerInterface;

class FingersCrossedHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var string|HandlerInterface
     */
    protected $handler;

    /**
     * @var int|string|ActivationStrategyInterface
     */
    protected $activationStrategy;

    /**
     * @var int
     */
    protected $bufferSize = 0;

    /**
     * @var bool
     */
    protected $stopBuffering = true;

    /**
     * @var int
     */
    protected $passthruLevel;

    /**
     * @param string $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return HandlerInterface|string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param string $activationStrategy
     */
    public function setActivationStrategy($activationStrategy)
    {
        $this->activationStrategy = $activationStrategy;
    }

    /**
     * @return string
     */
    public function getActivationStrategy()
    {
        return $this->activationStrategy;
    }

    /**
     * @param int $bufferSize
     */
    public function setBufferSize($bufferSize)
    {
        $this->bufferSize = $bufferSize;
    }

    /**
     * @return int
     */
    public function getBufferSize()
    {
        return $this->bufferSize;
    }

    /**
     * @param bool $stopBuffering
     */
    public function setStopBuffering($stopBuffering)
    {
        $this->stopBuffering = $stopBuffering;
    }

    /**
     * @return bool
     */
    public function getStopBuffering()
    {
        return $this->stopBuffering;
    }

    /**
     * @param int $passthruLevel
     */
    public function setPassthruLevel($passthruLevel)
    {
        $this->passthruLevel = $passthruLevel;
    }

    /**
     * @return int
     */
    public function getPassthruLevel()
    {
        return $this->passthruLevel;
    }
} 