<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\LogglyFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\LogglyFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogglyFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return LogglyFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new LogglyFormatterOptions($options);

        return new LogglyFormatter(
            $formatterOptions->getBatchMode(),
            $formatterOptions->getAppendNewline()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LogglyFormatter::class, $this->creationOptions);
    }
}
