<?php

namespace MonologModule\Processor\Options;

use Zend\Stdlib\AbstractOptions;

class UidProcessorOptions extends AbstractOptions
{
    /**
     * @var int
     */
    protected $length = 7;

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }
}
