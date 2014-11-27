<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\WebProcessor;
use MonologModule\Processor\Options\WebProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class WebProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return WebProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new WebProcessorOptions($this->creationOptions);

        return new WebProcessor(
            $options->getServerData(),
            $options->getExtraFields()
        );
    }
}
