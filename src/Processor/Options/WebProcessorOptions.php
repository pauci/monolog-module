<?php

namespace MonologModule\Processor\Options;

use Zend\Stdlib\AbstractOptions;

class WebProcessorOptions extends AbstractOptions
{
    /**
     * @var array|\ArrayAccess
     */
    protected $serverData;

    /**
     * @var array|null
     */
    protected $extraFields;

    /**
     * @param array|null $extraFields
     */
    public function setExtraFields($extraFields)
    {
        $this->extraFields = $extraFields;
    }

    /**
     * @param array|\ArrayAccess $serverData
     */
    public function setServerData($serverData)
    {
        $this->serverData = $serverData;
    }

    /**
     * @return array|null
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @return array|\ArrayAccess
     */
    public function getServerData()
    {
        return $this->serverData;
    }
}
