<?php

namespace MonologModule\Formatter\Options;

use Monolog\Formatter\JsonFormatter;
use Zend\Stdlib\AbstractOptions;

class JsonFormatterOptions extends AbstractOptions
{
    /**
     * @var int
     */
    protected $batchMode = JsonFormatter::BATCH_MODE_JSON;

    /**
     * @var bool
     */
    protected $appendNewline = true;

    /**
     * @param boolean $appendNewline
     */
    public function setAppendNewline($appendNewline)
    {
        $this->appendNewline = $appendNewline;
    }

    /**
     * @param int $batchMode
     */
    public function setBatchMode($batchMode)
    {
        $this->batchMode = $batchMode;
    }

    /**
     * @return boolean
     */
    public function getAppendNewline()
    {
        return $this->appendNewline;
    }

    /**
     * @return int
     */
    public function getBatchMode()
    {
        return $this->batchMode;
    }
}
