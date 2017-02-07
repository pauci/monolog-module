<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\IntrospectionProcessor;
use MonologModule\Processor\Options\IntrospectionProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class IntrospectionProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return IntrospectionProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new IntrospectionProcessorOptions($this->creationOptions);

        return new IntrospectionProcessor(
            $options->getLevel(),
            $options->getSkipClassesPartials()
        );
    }
}
