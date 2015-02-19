<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\ElasticSearchHandler;
use MonologModule\Handler\Options\ElasticSearchHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ElasticSearchHandlerFactory extends AbstractPluginFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ElasticSearchHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new ElasticSearchHandlerOptions($this->creationOptions);

        $client = $options->getClient();
        if (is_string($client)) {
            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $client = $serviceLocator->get($client);
        }

        return new ElasticSearchHandler(
            $client,
            $options->getOptions(),
            $options->getLevel(),
            $options->getBubble()
        );
    }
}