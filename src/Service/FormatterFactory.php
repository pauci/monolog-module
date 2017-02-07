<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\FormatterInterface;
use MonologModule\Formatter\FormatterPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormatterFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return FormatterInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $this->getOptions($container, 'formatter');

        $type = isset($options['type']) ? $options['type'] : $this->getName();
        unset($options['type']);

        return $container->get(FormatterPluginManager::class)
            ->get($type, $options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, FormatterInterface::class);
    }
}
