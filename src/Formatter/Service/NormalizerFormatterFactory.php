<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\NormalizerFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\NormalizerFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class NormalizerFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return NormalizerFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new NormalizerFormatterOptions($this->creationOptions);

        return new NormalizerFormatter(
            $options->getDateFormat()
        );
    }
}
