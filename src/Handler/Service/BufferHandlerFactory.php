<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
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
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return BufferHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new BufferHandlerOptions($options);

        $handler = $handlerOptions->getHandler();
        if (is_string($handler)) {
            /** @var HandlerInterface $handler */
            $handler = $container->get("monolog.handler.$handler");
        }

        return new BufferHandler(
            $handler,
            $handlerOptions->getBufferLimit(),
            $handlerOptions->getLevel(),
            $handlerOptions->getBubble(),
            $handlerOptions->getFlushOnOverflow()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, BufferHandler::class, $this->creationOptions);
    }
}
