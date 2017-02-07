<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use MonologModule\Handler\Options\StreamHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StreamHandlerFactory extends AbstractPluginFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return StreamHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new StreamHandlerOptions($options);

        $stream = $handlerOptions->getStream();
        if (is_string($stream)) {
            if ($container instanceof ServiceLocatorAwareInterface) {
                $container = $container->getServiceLocator();
            }
            $stream = $container->get($stream);
        }
        if (!$stream) {
            $stream = $handlerOptions->getUrl();
        }

        return new StreamHandler(
            $stream,
            $handlerOptions->getLevel(),
            $handlerOptions->getBubble(),
            $handlerOptions->getFilePermission(),
            $handlerOptions->getUseLocking()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, StreamHandler::class, $this->creationOptions);
    }
}