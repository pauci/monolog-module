<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\FingersCrossedHandler;
use MonologModule\Handler\Options\FingersCrossedHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class FingersCrossedHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FingersCrossedHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new FingersCrossedHandlerOptions($this->creationOptions);

        $handler = $options->getHandler();
        if (is_string($handler)) {
            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $handler = function() use($serviceLocator, $handler) {
                return $serviceLocator->get("monolog.handler.$handler");
            };
        }

        $activationStrategy = $options->getActivationStrategy();
        if (is_string($activationStrategy) && class_exists($activationStrategy)) {
            $activationStrategy = new $activationStrategy();
        }

        return new FingersCrossedHandler(
            $handler,
            $activationStrategy,
            $options->getBufferSize(),
            $options->getBubble(),
            $options->getPassthruLevel()
        );
    }
}