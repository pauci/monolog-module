<?php

namespace MonologModule\Formatter\Options;

use Zend\Stdlib\AbstractOptions;

class GelfMessageFormatterOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $systemName;

    /**
     * @var string
     */
    protected $extraPrefix;

    /**
     * @var string
     */
    protected $contextPrefix = 'ctxt_';

    /**
     * @param string $contextPrefix
     */
    public function setContextPrefix($contextPrefix)
    {
        $this->contextPrefix = $contextPrefix;
    }

    /**
     * @param string $extraPrefix
     */
    public function setExtraPrefix($extraPrefix)
    {
        $this->extraPrefix = $extraPrefix;
    }

    /**
     * @param string $systemName
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;
    }

    /**
     * @return string
     */
    public function getContextPrefix()
    {
        return $this->contextPrefix;
    }

    /**
     * @return string
     */
    public function getExtraPrefix()
    {
        return $this->extraPrefix;
    }

    /**
     * @return string
     */
    public function getSystemName()
    {
        return $this->systemName;
    }
}
