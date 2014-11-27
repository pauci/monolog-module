<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\BufferHandler;
use Monolog\Handler\HandlerInterface;
use MonologModule\Handler\Options\BufferHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class BufferHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return BufferHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new BufferHandlerOptions($this->creationOptions);

        $handler = $options->getHandler();
        if (is_string($handler)) {
            /** @var HandlerInterface $handler */
            $handler = $serviceLocator->get("monolog.handler.$handler");
        }

        return new BufferHandler(
            $handler,
            $options->getBufferLimit(),
            $options->getLevel(),
            $options->getBubble(),
            $options->getFlushOnOverflow()
        );
    }
}
