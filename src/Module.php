<?php

namespace MonologModule;

use Monolog\ErrorHandler;
use MonologModule\Options\ErrorHandlerOptions;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()
            ->getServiceManager();

        $options = $serviceManager->get('Config');
        $options = isset($options['monolog_error_handler']) ? $options['monolog_error_handler'] : null;
        $options = new ErrorHandlerOptions($options);

        if (!$options->getEnabled()) {
            return;
        }

        $logger = $options->getLogger();
        if (is_string($logger)) {
            $logger = $serviceManager->get("monolog.logger.$logger");
        }

        ErrorHandler::register(
            $logger,
            $options->getErrorLevelMap(),
            $options->getExceptionLevel(),
            $options->getFatalLevel()
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
