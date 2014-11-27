<?php

namespace MonologModule\Service;

use MonologModule\Processor\ProcessorPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProcessorFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return callable
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator, 'processor');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $serviceLocator->get(ProcessorPluginManager::class)
            ->get($type, $options);
    }
}
