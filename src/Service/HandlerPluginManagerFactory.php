<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Handler\HandlerPluginManager;

class HandlerPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pluginManager = new HandlerPluginManager();
        $pluginManager->setServiceLocator($container);
        return $pluginManager;
    }
}
