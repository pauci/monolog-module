<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Handler\HandlerPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class HandlerPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pluginManager = new HandlerPluginManager();
        if ($pluginManager instanceof ServiceLocatorAwareInterface) {
            $pluginManager->setServiceLocator($container);
        }
        return $pluginManager;
    }
}
