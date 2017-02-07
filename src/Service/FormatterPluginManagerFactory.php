<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Formatter\FormatterPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class FormatterPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pluginManager = new FormatterPluginManager();
        if ($pluginManager instanceof ServiceLocatorAwareInterface) {
            $pluginManager->setServiceLocator($container);
        }
        return $pluginManager;
    }
}
