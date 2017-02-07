<?php

namespace MonologModule\Processor\Service;

use Monolog\Processor\GitProcessor;
use MonologModule\Processor\Options\GitProcessorOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class GitProcessorFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return GitProcessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new GitProcessorOptions($this->creationOptions);

        return new GitProcessor(
            $options->getLevel()
        );
    }
}
