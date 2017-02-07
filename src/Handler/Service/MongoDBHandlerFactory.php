<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\MongoDBHandler;
use MonologModule\Handler\Options\MongoDBHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoDBHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return MongoDBHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new MongoDBHandlerOptions($options);

        return new MongoDBHandler(
            $handlerOptions->getMongo(),
            $handlerOptions->getDatabase(),
            $handlerOptions->getCollection(),
            $handlerOptions->getLevel(),
            $handlerOptions->getBubble()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, MongoDBHandler::class, $this->creationOptions);
    }
}
