<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Processor\ProcessorPluginManager;

class ProcessorPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pluginManager = new ProcessorPluginManager();
        $pluginManager->setServiceLocator($container);
        return $pluginManager;
    }
}
