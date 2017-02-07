<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\GelfMessageFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\GelfMessageFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class GelfMessageFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return GelfMessageFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new GelfMessageFormatterOptions($options);

        return new GelfMessageFormatter(
            $formatterOptions->getSystemName(),
            $formatterOptions->getExtraPrefix(),
            $formatterOptions->getContextPrefix()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, GelfMessageFormatter::class, $this->creationOptions);
    }
}
