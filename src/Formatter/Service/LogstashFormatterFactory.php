<?php

namespace MonologModule\Formatter\Service;

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
     * @param ServiceLocatorInterface $serviceLocator
     * @return LogstashFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new LogstashFormatterOptions($this->creationOptions);

        $applicationName = $options->getApplicationName();
        if (!$applicationName) {
            throw new InvalidArgumentException('Logstash formatter must have an application name specified');
        }

        return new LogstashFormatter(
            $applicationName,
            $options->getSystemName(),
            $options->getExtraPrefix(),
            $options->getContextPrefix(),
            $options->getVersion()
        );
    }
}
