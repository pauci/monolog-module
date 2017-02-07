<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Processor\ProcessorPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProcessorFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return callable
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $this->getOptions($container, 'processor');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $container->get(ProcessorPluginManager::class)
            ->get($type, $options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'Monolog\Processor');
    }
}
