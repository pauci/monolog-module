<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\FlowdockFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Exception\InvalidArgumentException;
use MonologModule\Formatter\Options\FlowdockFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class FlowdockFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FlowdockFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new FlowdockFormatterOptions($this->creationOptions);

        $source      = $options->getSource();
        $sourceEmail = $options->getSourceEmail();
        if (!$source) {
            throw new InvalidArgumentException('Flowdock formatter must have a source specified');
        }
        if (!$sourceEmail) {
            throw new InvalidArgumentException('Flowdock formatter must have a source email specified');
        }

        return new FlowdockFormatter($source, $sourceEmail);
    }
}
