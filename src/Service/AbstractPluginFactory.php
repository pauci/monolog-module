<?php

namespace MonologModule\Service;

use Zend\ServiceManager\FactoryInterface;

abstract class AbstractPluginFactory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $creationOptions;

    /**
     * @param array $options
     */
    public function setCreationOptions(array $options)
    {
        $this->creationOptions = $options;
    }
}
