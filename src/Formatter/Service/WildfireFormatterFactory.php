<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\WildfireFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\NormalizerFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class WildfireFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return WildfireFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new NormalizerFormatterOptions($options);

        return new WildfireFormatter(
            $formatterOptions->getDateFormat()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, WildfireFormatter::class, $this->creationOptions);
    }
}
