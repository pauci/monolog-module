<?php

namespace MonologModule\Options;

use Zend\Stdlib\AbstractOptions;

class ErrorHandlerOptions extends AbstractOptions
{
    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var \Psr\Log\LoggerInterface|string
     */
    protected $logger = 'default';

    /**
     * @var array|false
     */
    protected $errorLevelMap = [];

    /**
     * @var int|false
     */
    protected $exceptionLevel;

    /**
     * @var int|false
     */
    protected $fatalLevel;

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param array|false $errorLevelMap
     */
    public function setErrorLevelMap($errorLevelMap)
    {
        $this->errorLevelMap = $errorLevelMap;
    }

    /**
     * @param false|int $exceptionLevel
     */
    public function setExceptionLevel($exceptionLevel)
    {
        $this->exceptionLevel = $exceptionLevel;
    }

    /**
     * @param false|int $fatalLevel
     */
    public function setFatalLevel($fatalLevel)
    {
        $this->fatalLevel = $fatalLevel;
    }

    /**
     * @param \Psr\Log\LoggerInterface|string $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return array|false
     */
    public function getErrorLevelMap()
    {
        return $this->errorLevelMap;
    }

    /**
     * @return false|int
     */
    public function getExceptionLevel()
    {
        return $this->exceptionLevel;
    }

    /**
     * @return false|int
     */
    public function getFatalLevel()
    {
        return $this->fatalLevel;
    }

    /**
     * @return \Psr\Log\LoggerInterface|string
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
