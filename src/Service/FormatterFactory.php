<?php

namespace MonologModule\Service;

use Monolog\Formatter\FormatterInterface;
use MonologModule\Formatter\FormatterPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormatterFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FormatterInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator, 'formatter');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $serviceLocator->get(FormatterPluginManager::class)
            ->get($type, $options);
    }
}
