<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\TagProcessor;
use MonologModule\Processor\Options\TagProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class TagProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TagProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new TagProcessorOptions($this->creationOptions);

        return new TagProcessor(
            $options->getTags()
        );
    }
}
