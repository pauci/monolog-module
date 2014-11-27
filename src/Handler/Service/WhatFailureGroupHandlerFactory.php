<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\WhatFailureGroupHandler;

class WhatFailureGroupHandlerFactory extends GroupHandlerFactory
{
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
