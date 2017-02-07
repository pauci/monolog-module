<?php

namespace MonologModule\Processor\Options;

use Monolog\Logger;
use Zend\Stdlib\AbstractOptions;

class GitProcessorOptions extends AbstractOptions
{
    /**
     * @var int
     */
    protected $level = Logger::DEBUG;

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }
}
