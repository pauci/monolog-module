<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\UidProcessor;
use MonologModule\Processor\Options\UidProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class UidProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return UidProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new UidProcessorOptions($this->creationOptions);

        return new UidProcessor(
            $options->getLength()
        );
    }
}
