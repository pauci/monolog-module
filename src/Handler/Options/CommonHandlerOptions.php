<?php

namespace MonologModule\Handler\Options;

use Monolog\Logger;
use Zend\Stdlib\AbstractOptions;

class CommonHandlerOptions extends AbstractOptions
{
    /**
     * @var int
     */
    protected $level = Logger::DEBUG;

    /**
     * @var bool
     */
    protected $bubble = true;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @var array
     */
    protected $processors = [];

    /**
     * @var string
     */
    protected $formatter;

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @param boolean $bubble
     */
    public function setBubble($bubble)
    {
        $this->bubble = $bubble;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param array $processors
     */
    public function setProcessors($processors)
    {
        $this->processors = $processors;
    }

    /**
     * @param string $formatter
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return boolean
     */
    public function getBubble()
    {
        return $this->bubble;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getProcessors()
    {
        return $this->processors;
    }

    /**
     * @return string
     */
    public function getFormatter()
    {
        return $this->formatter;
    }
}
