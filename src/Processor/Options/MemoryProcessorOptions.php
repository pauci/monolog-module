<?php

namespace MonologModule\Processor\Options;

use Zend\Stdlib\AbstractOptions;

class MemoryProcessorOptions extends AbstractOptions
{
    /**
     * @var bool
     */
    protected $realUsage = true;

    /**
     * @var bool
     */
    protected $useFormatting = true;

    /**
     * @param boolean $realUsage
     */
    public function setRealUsage($realUsage)
    {
        $this->realUsage = $realUsage;
    }

    /**
     * @param boolean $useFormatting
     */
    public function setUseFormatting($useFormatting)
    {
        $this->useFormatting = $useFormatting;
    }

    /**
     * @return boolean
     */
    public function getRealUsage()
    {
        return $this->realUsage;
    }

    /**
     * @return boolean
     */
    public function getUseFormatting()
    {
        return $this->useFormatting;
    }
}
