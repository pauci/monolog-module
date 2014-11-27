<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\LogglyFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\LogglyFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogglyFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return LogglyFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new LogglyFormatterOptions($this->creationOptions);

        return new LogglyFormatter(
            $options->getBatchMode(),
            $options->getAppendNewline()
        );
    }
}
