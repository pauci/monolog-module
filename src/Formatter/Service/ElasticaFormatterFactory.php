<?php

namespace MonologModule\Formatter\Service;

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
     * @param ServiceLocatorInterface $serviceLocator
     * @return ElasticaFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new ElasticaFormatterOptions($this->creationOptions);

        $index = $options->getIndex();
        $type  = $options->getType();

        if (!$index) {
            throw new InvalidArgumentException('Elastica formatter must have an index specified');
        }
        if (!$type) {
            throw new InvalidArgumentException('Elastica formatter must have a type specified');
        }

        return new ElasticaFormatter($index, $type);
    }
}
