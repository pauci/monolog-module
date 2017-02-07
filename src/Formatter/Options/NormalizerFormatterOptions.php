<?php

namespace MonologModule\Formatter\Options;

use Zend\Stdlib\AbstractOptions;

class NormalizerFormatterOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @param string $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }
}
