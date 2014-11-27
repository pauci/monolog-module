<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\RedisHandler;
use MonologModule\Exception\InvalidArgumentException;
use MonologModule\Handler\Options\RedisHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class RedisHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return RedisHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new RedisHandlerOptions($this->creationOptions);

        $redis = $options->getRedis();
        if (is_string($redis)) {
            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $redis = $serviceLocator->get($redis);
        }

        $key = $options->getKey();
        if (!$key) {
            throw new InvalidArgumentException('Redis handler must have a key specified');
        }

        return new RedisHandler(
            $redis,
            $key,
            $options->getLevel(),
            $options->getBubble()
        );
    }
}