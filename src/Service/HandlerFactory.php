<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler;
use Monolog\Handler\HandlerInterface;
use MonologModule\Handler\HandlerPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class HandlerFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return HandlerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $this->getOptions($container, 'handler');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $container->get(HandlerPluginManager::class)
            ->get($type, $options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, Handler\HandlerInterface::class);
    }
}
