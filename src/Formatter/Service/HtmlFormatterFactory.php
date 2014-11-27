<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\HtmlFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\NormalizerFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class HtmlFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return HtmlFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new NormalizerFormatterOptions($this->creationOptions);

        return new HtmlFormatter(
            $options->getDateFormat()
        );
    }
}
