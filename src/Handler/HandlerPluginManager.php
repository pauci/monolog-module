<?php

namespace MonologModule\Handler;

use Monolog\Formatter\FormatterInterface;
use Monolog\Handler;
use Monolog\Handler\HandlerInterface;
use Monolog\Processor\TagProcessor;
use MonologModule\Exception;
use MonologModule\Handler\Options\CommonHandlerOptions;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;

class HandlerPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = [
        'browserconsole' => Handler\BrowserConsoleHandler::class,
        'chromephp'      => Handler\ChromePHPHandler::class,
        'exceptiontest'  => Handler\ExceptionTestHandler::class,
        'firephp'        => Handler\FirePHPHandler::class,
        'null'           => Handler\NullHandler::class,
        'test'           => Handler\TestHandler::class,
        'zendmonitor'    => Handler\ZendMonitorHandler::class,
    ];

    protected $factories = [
        'elasticsearch'    => Service\ElasticSearchHandlerFactory::class,
        'fingerscrossed'   => Service\FingersCrossedHandlerFactory::class,
        'group'            => Service\GroupHandlerFactory::class,
        'mongodb'          => Service\MongoDBHandlerFactory::class,
        'redis'            => Service\RedisHandlerFactory::class,
        'stream'           => Service\StreamHandlerFactory::class,
        'whatfailuregroup' => Service\WhatFailureGroupHandlerFactory::class,
    ];

    /**
     * Allow many handlers of same type
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * @param ConfigInterface $configuration
     */
    public function __construct(ConfigInterface $configuration = null)
    {
        parent::__construct($configuration);

        $this->addInitializer([$this, 'injectFormatter']);
        $this->addInitializer([$this, 'injectProcessors']);
    }

    /**
     * @param HandlerInterface $handler
     */
    public function injectFormatter($handler)
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
     * @param HandlerInterface $handler
     */
    public function injectProcessors($handler)
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

    /**
     * Validate the plugin
     *
     * Checks that the handler is an instance of HandlerInterface
     *
     * @param  mixed $plugin
     * @throws Exception\InvalidHandlerException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof HandlerInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidHandlerException(sprintf(
            'Plugin of type %s is invalid; must implement Monolog\Handler\HandlerInterface',
            is_object($plugin) ? get_class($plugin) : gettype($plugin)
        ));
    }
}
