<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\MongoDBHandler;
use MonologModule\Handler\Options\MongoDBHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoDBHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MongoDBHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new MongoDBHandlerOptions($this->creationOptions);

        return new MongoDBHandler(
            $options->getMongo(),
            $options->getDatabase(),
            $options->getCollection(),
            $options->getLevel(),
            $options->getBubble()
        );
    }
}
