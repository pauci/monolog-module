<?php

namespace MonologModule\Processor\Options;

use Monolog\Logger;
use Zend\Stdlib\AbstractOptions;

class IntrospectionProcessorOptions extends AbstractOptions
{
    /**
     * @var int
     */
    protected $level = Logger::DEBUG;

    /**
     * @var array
     */
    protected $skipClassesPartials = ['Monolog\\'];

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @param array $skipClassesPartials
     */
    public function setSkipClassesPartials($skipClassesPartials)
    {
        $this->skipClassesPartials = $skipClassesPartials;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return array
     */
    public function getSkipClassesPartials()
    {
        return $this->skipClassesPartials;
    }
}
