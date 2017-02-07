<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\RedisHandler;
use MonologModule\Exception\InvalidArgumentException;
use MonologModule\Handler\Options\RedisHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RedisHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return RedisHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new RedisHandlerOptions($options);

        $redis = $handlerOptions->getRedis();
        if (is_string($redis)) {
            if ($container instanceof ServiceLocatorAwareInterface) {
                $container = $container->getServiceLocator();
            }
            $redis = $container->get($redis);
        }

        $key = $handlerOptions->getKey();
        if (!$key) {
            throw new InvalidArgumentException('Redis handler must have a key specified');
        }

        return new RedisHandler(
            $redis,
            $key,
            $handlerOptions->getLevel(),
            $handlerOptions->getBubble()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, RedisHandler::class, $this->creationOptions);
    }
}