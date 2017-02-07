<?php

namespace MonologModule\Service;

use Interop\Container\ContainerInterface;
use MonologModule\Formatter\FormatterPluginManager;

class FormatterPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new FormatterPluginManager($container);
    }
}
