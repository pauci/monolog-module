<?php

namespace MonologModule\ServiceFactory;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractLoggerFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return false !== $this->getFactoryMapping($serviceLocator, $requestedName);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $mappings = $this->getFactoryMapping($serviceLocator, $requestedName);

        if (!$mappings) {
            throw new ServiceNotFoundException();
        }

        $factoryClass = $mappings['factoryClass'];
        /* @var $factory \MonologModule\Service\AbstractFactory */
        $factory      = new $factoryClass($mappings['serviceName']);

        return $factory->createService($serviceLocator);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param string $name
     *
     * @return bool|array
     */
    private function getFactoryMapping(ServiceLocatorInterface $serviceLocator, $name)
    {
        $matches = [];

        if (!preg_match('/^monolog\.(?P<serviceType>[a-z0-9_]+)\.(?P<serviceName>[a-z0-9_]+)$/i', $name, $matches)) {
            return false;
        }

        $config      = $serviceLocator->get('Config');
        $serviceType = $matches['serviceType'];
        $serviceName = $matches['serviceName'];

        if (!isset($config['monolog_factories'][$serviceType])
            || !isset($config['monolog'][$serviceType][$serviceName])
        ) {
            return false;
        }

        return [
            'serviceType'  => $serviceType,
            'serviceName'  => $serviceName,
            'factoryClass' => $config['monolog_factories'][$serviceType],
        ];
    }
}