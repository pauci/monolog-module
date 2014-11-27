<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\MemoryPeakUsageProcessor;
use MonologModule\Processor\Options\MemoryProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class MemoryPeakUsageProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MemoryPeakUsageProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new MemoryProcessorOptions($this->creationOptions);

        return new MemoryPeakUsageProcessor(
            $options->getRealUsage(),
            $options->getUseFormatting()
        );
    }
}
