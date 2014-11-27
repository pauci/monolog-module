<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\JsonFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\JsonFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class JsonFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return JsonFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new JsonFormatterOptions($this->creationOptions);

        return new JsonFormatter(
            $options->getBatchMode(),
            $options->getAppendNewline()
        );
    }
}
