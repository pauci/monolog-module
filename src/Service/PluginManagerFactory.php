<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class PluginManagerFactory
{
    public function __invoke(ContainerInterface $container, $class)
    {
        $pm = new $class;
        if (!$pm instanceof AbstractPluginManager) {
            throw new \RuntimeException(sprintf(
                'Plugin manager must be an instance of %s; got %s',
                AbstractPluginManager::class,
                get_class($pm)
            ));
        }

        if ($container instanceof ServiceLocatorInterface) {
            $pm->setServiceLocator($container);
        }
        return $pm;
    }
}
