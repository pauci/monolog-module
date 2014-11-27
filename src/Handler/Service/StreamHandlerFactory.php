<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\StreamHandler;
use MonologModule\Handler\Options\StreamHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class StreamHandlerFactory extends AbstractPluginFactory
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return StreamHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new StreamHandlerOptions($this->creationOptions);

        $stream = $options->getStream();
        if (is_string($stream)) {
            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $stream = $serviceLocator->get($stream);
        }
        if (!$stream) {
            $stream = $options->getUrl();
        }

        return new StreamHandler(
            $stream,
            $options->getLevel(),
            $options->getBubble(),
            $options->getFilePermission(),
            $options->getUseLocking()
        );
    }
}