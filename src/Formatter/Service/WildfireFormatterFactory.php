<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\WildfireFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\NormalizerFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class WildfireFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return WildfireFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new NormalizerFormatterOptions($this->creationOptions);

        return new WildfireFormatter(
            $options->getDateFormat()
        );
    }
}
