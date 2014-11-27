<?php

namespace MonologModule\Service;

use MonologModule\Exception\RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractFactory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets options from configuration based on name.
     *
     * @param  ServiceLocatorInterface $sl
     * @param  string $key
     * @param  null|string $name
     * @return array
     * @throws RuntimeException
     */
    public function getOptions(ServiceLocatorInterface $sl, $key, $name = null)
    {
        if ($name === null) {
            $name = $this->getName();
        }

        $options = $sl->get('Configuration');
        $options = $options['monolog'];
        $options = isset($options[$key][$name]) ? $options[$key][$name] : null;

        if (null === $options) {
            throw new RuntimeException(sprintf(
                'Options with name "%s" could not be found in "monolog.%s".',
                $name,
                $key
            ));
        }

        return $options;
    }

}
