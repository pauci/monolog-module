<?php

namespace MonologModule\ServiceFactory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractLoggerFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return false !== $this->getFactoryMapping($container, $requestedName);
    }

    /**
     * Create service with name
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mappings = $this->getFactoryMapping($container, $requestedName);

        if (!$mappings) {
            throw new ServiceNotFoundException();
        }

        $factoryClass = $mappings['factoryClass'];
        /* @var \MonologModule\Service\AbstractFactory $factory */
        $factory = new $factoryClass($mappings['serviceName']);

        return $factory($container, $requestedName, $options);
    }

    /**
     * {@inheritDoc}
     * @deprecated
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $container, $name, $requestedName)
    {
        return $this->canCreate($container, $requestedName);
    }

    /**
     * {@inheritDoc}
     * @deprecated
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this($serviceLocator, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param string $name
     * @return bool|array
     */
    private function getFactoryMapping(ContainerInterface $container, $name)
    {
        $matches = [];

        if (!preg_match('/^monolog\.(?P<serviceType>[a-z0-9_]+)\.(?P<serviceName>[a-z0-9_]+)$/i', $name, $matches)) {
            return false;
        }

        $config = $container->get('Config');
        $serviceType = $matches['serviceType'];
        $serviceName = $matches['serviceName'];

        if (!isset(
            $config['monolog_factories'][$serviceType],
            $config['monolog'][$serviceType][$serviceName]
        )) {
            return false;
        }

        return [
            'serviceType' => $serviceType,
            'serviceName' => $serviceName,
            'factoryClass' => $config['monolog_factories'][$serviceType],
        ];
    }
}
