<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\WhatFailureGroupHandler;
use Zend\ServiceManager\ServiceLocatorInterface;

class WhatFailureGroupHandlerFactory extends GroupHandlerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, WhatFailureGroupHandler::class, $this->creationOptions);
    }

    /**
     * @param array $handlers
     * @param bool $bubble
     * @return WhatFailureGroupHandler
     */
    protected function create($handlers, $bubble)
    {
        return new WhatFailureGroupHandler($handlers, $bubble);
    }
}
