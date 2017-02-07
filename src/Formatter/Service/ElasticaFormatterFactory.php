<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\ElasticaFormatter;
use MonologModule\Exception\InvalidArgumentException;
use MonologModule\Formatter\Options\ElasticaFormatterOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class ElasticaFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return ElasticaFormatter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formatterOptions = new ElasticaFormatterOptions($options);

        $index = $formatterOptions->getIndex();
        $type = $formatterOptions->getType();

        if (!$index) {
            throw new InvalidArgumentException('Elastica formatter must have an index specified');
        }
        if (!$type) {
            throw new InvalidArgumentException('Elastica formatter must have a type specified');
        }

        return new ElasticaFormatter($index, $type);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, ElasticaFormatter::class, $this->creationOptions);
    }
}
