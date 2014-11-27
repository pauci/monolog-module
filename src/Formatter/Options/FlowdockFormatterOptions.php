<?php

namespace MonologModule\Formatter\Options;

use Zend\Stdlib\AbstractOptions;

class FlowdockFormatterOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $sourceEmail;

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @param string $sourceEmail
     */
    public function setSourceEmail($sourceEmail)
    {
        $this->sourceEmail = $sourceEmail;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getSourceEmail()
    {
        return $this->sourceEmail;
    }
}