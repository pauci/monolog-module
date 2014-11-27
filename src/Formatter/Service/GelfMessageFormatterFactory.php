<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\GelfMessageFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\GelfMessageFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class GelfMessageFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return GelfMessageFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new GelfMessageFormatterOptions($this->creationOptions);

        return new GelfMessageFormatter(
            $options->getSystemName(),
            $options->getExtraPrefix(),
            $options->getContextPrefix()
        );
    }
}
