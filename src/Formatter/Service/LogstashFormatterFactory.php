<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\LogstashFormatter;
use MonologModule\Exception\InvalidArgumentException;
use MonologModule\Formatter\Options\LogstashFormatterOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogstashFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return LogstashFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new LogstashFormatterOptions($options);

        $applicationName = $formatterOptions->getApplicationName();
        if (!$applicationName) {
            throw new InvalidArgumentException('Logstash formatter must have an application name specified');
        }

        return new LogstashFormatter(
            $applicationName,
            $formatterOptions->getSystemName(),
            $formatterOptions->getExtraPrefix(),
            $formatterOptions->getContextPrefix(),
            $formatterOptions->getVersion()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LogstashFormatter::class, $this->creationOptions);
    }
}
