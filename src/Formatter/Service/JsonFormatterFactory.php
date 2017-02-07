<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\JsonFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\JsonFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class JsonFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return JsonFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new JsonFormatterOptions($options);

        return new JsonFormatter(
            $formatterOptions->getBatchMode(),
            $formatterOptions->getAppendNewline()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, JsonFormatter::class, $this->creationOptions);
    }
}
