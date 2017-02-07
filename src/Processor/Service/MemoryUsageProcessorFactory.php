<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\MemoryUsageProcessor;
use MonologModule\Processor\Options\MemoryProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class MemoryUsageProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MemoryUsageProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new MemoryProcessorOptions($this->creationOptions);

        return new MemoryUsageProcessor(
            $options->getRealUsage(),
            $options->getUseFormatting()
        );
    }
}
