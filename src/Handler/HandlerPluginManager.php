<?php

namespace MonologModule\Handler;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler;
use Monolog\Handler\HandlerInterface;
use Monolog\Processor\TagProcessor;
use MonologModule\Handler\Options\CommonHandlerOptions;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Factory\InvokableFactory;

class HandlerPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    protected $aliases = [
        'browserconsole'   => Handler\BrowserConsoleHandler::class,
        'chromephp'        => Handler\ChromePHPHandler::class,
        'elasticsearch'    => Handler\ElasticSearchHandler::class,
        'exceptiontest'    => Handler\ExceptionTestHandler::class,
        'fingerscrossed'   => Handler\FingersCrossedHandler::class,
        'firephp'          => Handler\FirePHPHandler::class,
        'group'            => Handler\GroupHandler::class,
        'mongodb'          => Handler\MongoDBHandler::class,
        'null'             => Handler\NullHandler::class,
        'redis'            => Handler\RedisHandler::class,
        'stream'           => Handler\StreamHandler::class,
        'test'             => Handler\TestHandler::class,
        'whatfailuregroup' => Handler\WhatFailureGroupHandler::class,
        'zendmonitor'      => Handler\ZendMonitorHandler::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $factories = [
        Handler\BrowserConsoleHandler::class   => InvokableFactory::class,
        Handler\ChromePHPHandler::class        => InvokableFactory::class,
        Handler\ElasticSearchHandler::class    => Service\ElasticSearchHandlerFactory::class,
        Handler\ExceptionTestHandler::class    => InvokableFactory::class,
        Handler\FingersCrossedHandler::class   => Service\FingersCrossedHandlerFactory::class,
        Handler\FirePHPHandler::class          => InvokableFactory::class,
        Handler\GroupHandler::class            => Service\GroupHandlerFactory::class,
        Handler\MongoDBHandler::class          => Service\MongoDBHandlerFactory::class,
        Handler\NullHandler::class             => InvokableFactory::class,
        Handler\RedisHandler::class            => Service\RedisHandlerFactory::class,
        Handler\StreamHandler::class           => Service\StreamHandlerFactory::class,
        Handler\TestHandler::class             => InvokableFactory::class,
        Handler\WhatFailureGroupHandler::class => Service\WhatFailureGroupHandlerFactory::class,
        Handler\ZendMonitorHandler::class      => InvokableFactory::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $sharedByDefault = false;

    /**
     * {@inheritDoc}
     */
    protected $instanceOf = HandlerInterface::class;

    /**
     * @param ContainerInterface $container
     * @param array $config
     */
    public function __construct(ContainerInterface $container, array $config = [])
    {
        parent::__construct($container, $config);

        $this->addInitializer([$this, 'injectFormatter']);
        $this->addInitializer([$this, 'injectProcessors']);
    }

    /**
     * @param ContainerInterface $container
     * @param HandlerInterface $handler
     */
    public function injectFormatter(ContainerInterface $container, HandlerInterface $handler)
    {
        if (empty($this->creationOptions['formatter'])) {
            return;
        }

        $formatter = $this->creationOptions['formatter'];
        if (is_string($formatter)) {
            /** @var FormatterInterface $formatter */
            $formatter = $this->getServiceLocator()->get("monolog.formatter.$formatter");
        }
        $handler->setFormatter($formatter);
    }

    /**
     * @param ContainerInterface $container
     * @param HandlerInterface $handler
     */
    public function injectProcessors(ContainerInterface $container, HandlerInterface $handler)
    {
        if (!empty($this->creationOptions['tags'])) {
            $tagProcessor = new TagProcessor($this->creationOptions['tags']);
            $handler->pushProcessor($tagProcessor);
        }

        if (empty($this->creationOptions['processors'])) {
            return;
        }

        foreach ($this->creationOptions['processors'] as $processor) {
            if (is_string($processor)) {
                /** @var callable $processor */
                $processor = $this->getServiceLocator()->get("monolog.processor.$processor");
            }
            $handler->pushProcessor($processor);
        }
    }

    /**
     * @param  string $canonicalName
     * @param  string $requestedName
     * @return null|\stdClass
     */
    protected function createFromInvokable($canonicalName, $requestedName)
    {
        $invokable = $this->invokableClasses[$canonicalName];
        $instance  = new $invokable();

        if ($instance instanceof Handler\AbstractHandler) {
            $options = new CommonHandlerOptions($this->creationOptions);
            $instance->setLevel($options->getLevel());
            $instance->setBubble($options->getBubble());
        }

        return $instance;
    }
}
