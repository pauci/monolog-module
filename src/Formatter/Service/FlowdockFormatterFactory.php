<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
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
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return FlowdockFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new FlowdockFormatterOptions($options);

        $source = $formatterOptions->getSource();
        $sourceEmail = $formatterOptions->getSourceEmail();
        if (!$source) {
            throw new InvalidArgumentException('Flowdock formatter must have a source specified');
        }
        if (!$sourceEmail) {
            throw new InvalidArgumentException('Flowdock formatter must have a source email specified');
        }

        return new FlowdockFormatter($source, $sourceEmail);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, FlowdockFormatter::class, $this->creationOptions);
    }
}
