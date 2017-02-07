<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\FingersCrossedHandler;
use MonologModule\Handler\Options\FingersCrossedHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FingersCrossedHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $serviceLocator
     * @param string $requestedName
     * @param array $options
     * @return FingersCrossedHandler
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $handlerOptions = new FingersCrossedHandlerOptions($options);

        $handler = $handlerOptions->getHandler();
        if (is_string($handler)) {
            if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $handler = function() use($serviceLocator, $handler) {
                return $serviceLocator->get("monolog.handler.$handler");
            };
        }

        $activationStrategy = $handlerOptions->getActivationStrategy();
        if (is_string($activationStrategy) && class_exists($activationStrategy)) {
            $activationStrategy = new $activationStrategy();
        }

        return new FingersCrossedHandler(
            $handler,
            $activationStrategy,
            $handlerOptions->getBufferSize(),
            $handlerOptions->getBubble(),
            $handlerOptions->getPassthruLevel()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, FingersCrossedHandler::class, $this->creationOptions);
    }
}