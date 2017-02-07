<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Processor\ProcessorPluginManager;

class ProcessorPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ProcessorPluginManager($container);
    }
}
