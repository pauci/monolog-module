<?php

namespace MonologModule\Service;

use Monolog\Handler;
use Monolog\Handler\HandlerInterface;
use MonologModule\Handler\HandlerPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class HandlerFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return HandlerInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator, 'handler');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $serviceLocator->get(HandlerPluginManager::class)
            ->get($type, $options);
    }
}
