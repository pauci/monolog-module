<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Handler\HandlerPluginManager;

class HandlerPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new HandlerPluginManager($container);
    }
}
