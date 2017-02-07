<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\ElasticSearchHandler;
use MonologModule\Handler\Options\ElasticSearchHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ElasticSearchHandlerFactory extends AbstractPluginFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return ElasticSearchHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new ElasticSearchHandlerOptions($options);

        $client = $handlerOptions->getClient();
        if (is_string($client)) {
            if ($container instanceof ServiceLocatorAwareInterface) {
                $container = $container->getServiceLocator();
            }
            $client = $container->get($client);
        }

        return new ElasticSearchHandler(
            $client,
            $handlerOptions->getOptions(),
            $handlerOptions->getLevel(),
            $handlerOptions->getBubble()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, ElasticSearchHandler::class, $this->creationOptions);
    }
}
