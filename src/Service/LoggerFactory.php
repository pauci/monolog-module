<?php

namespace MonologModule\Service;

use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Monolog\Processor\TagProcessor;
use MonologModule\Exception;
use MonologModule\Handler\HandlerPluginManager;
use MonologModule\Options\LoggerOptions;
use MonologModule\Processor\ProcessorPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggerFactory extends AbstractFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Logger
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator, 'logger');
        $options = new LoggerOptions($options);
        return $this->create($serviceLocator, $options);
    }

    /**
     * @param ServiceLocatorInterface $sl
     * @param LoggerOptions $options
     * @return Logger
     */
    public function create(ServiceLocatorInterface $sl, LoggerOptions $options)
    {
        $name = $options->getName();
        if (!$name) {
            throw new Exception\InvalidArgumentException('Logger must have a name');
        }

        $logger = new Logger($name);

        $tags = $options->getTags();
        if (!empty($tags)) {
            $tagProcessor = new TagProcessor($tags);
            $logger->pushProcessor($tagProcessor);
        }

        foreach ($options->getProcessors() as $processor) {
            if (is_string($processor)) {
                /** @var callable $processor */
                $processor = $sl->get("monolog.processor.$processor");
            } elseif (is_array($processor)) {
                if (empty($processor['type'])) {
                    throw new Exception\InvalidArgumentException('Type of processor must be specified');
                }
                $type = $processor['type'];
                unset($processor['type']);
                $processor = $sl->get(ProcessorPluginManager::class)->get($type, $processor);
            }
            $logger->pushProcessor($processor);
        }

        foreach ($options->getHandlers() as $handler) {
            if (is_string($handler)) {
                $handler = $sl->get("monolog.handler.$handler");
            } elseif (is_array($handler)) {
                if (empty($handler['type'])) {
                    throw new Exception\InvalidArgumentException('Type of handler must be specified');
                }
                $type = $handler['type'];
                unset($handler['type']);
                $handler = $sl->get(HandlerPluginManager::class)->get($type, $handler);
            }
            /** @var HandlerInterface $handler */
            $logger->pushHandler($handler);
        }

        return $logger;
    }
}