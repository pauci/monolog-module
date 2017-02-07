<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Processor\ProcessorPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class ProcessorPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pluginManager = new ProcessorPluginManager();
        if ($pluginManager instanceof ServiceLocatorAwareInterface) {
            $pluginManager->setServiceLocator($container);
        }
        return $pluginManager;
    }
}
