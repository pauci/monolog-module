<?php

namespace MonologModule\Formatter\Options;

use Monolog\Formatter\LogstashFormatter;
use Zend\Stdlib\AbstractOptions;

class LogstashFormatterOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $applicationName;

    /**
     * @var string|null
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
     * @var int
     */
    protected $version = LogstashFormatter::V0;

    /**
     * @param string $applicationName
     * @return $this
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
        return $this;
    }

    /**
     * @param string $contextPrefix
     * @return $this
     */
    public function setContextPrefix($contextPrefix)
    {
        $this->contextPrefix = $contextPrefix;
        return $this;
    }

    /**
     * @param string $extraPrefix
     * @return $this
     */
    public function setExtraPrefix($extraPrefix)
    {
        $this->extraPrefix = $extraPrefix;
        return $this;
    }

    /**
     * @param null|string $systemName
     * @return $this
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;
        return $this;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getApplicationName()
    {
        return $this->applicationName;
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
     * @return null|string
     */
    public function getSystemName()
    {
        return $this->systemName;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}
