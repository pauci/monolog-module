<?php

namespace MonologModule\Handler\Options;

class GroupHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @param array $handlers
     */
    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }
}
