<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\ScalarFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\NormalizerFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class ScalarFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ScalarFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new NormalizerFormatterOptions($this->creationOptions);

        return new ScalarFormatter(
            $options->getDateFormat()
        );
    }
}
