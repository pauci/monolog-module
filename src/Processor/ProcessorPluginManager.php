<?php

namespace MonologModule\Processor;

use Monolog\Processor;
use MonologModule\Exception;
use Zend\ServiceManager\AbstractPluginManager;

class ProcessorPluginManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    protected $invokableClasses = [
        'processid'     => Processor\ProcessIdProcessor::class,
        'psrlogmessage' => Processor\PsrLogMessageProcessor::class,
    ];

    /**
     * @var array
     */
    protected $factories = [
        'git'             => Service\GitProcessorFactory::class,
        'introspection'   => Service\IntrospectionProcessorFactory::class,
        'memorypeakusage' => Service\MemoryPeakUsageProcessorFactory::class,
        'memoryusage'     => Service\MemoryUsageProcessorFactory::class,
        'tag'             => Service\TagProcessorFactory::class,
        'uid'             => Service\UidProcessorFactory::class,
        'web'             => Service\WebProcessorFactory::class,
    ];

    /**
     * Allow many processors of same type
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * Validate the plugin
     *
     * Checks that the processor is callable
     *
     * @param  mixed $plugin
     * @throws Exception\InvalidArgumentException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if (is_callable($plugin)) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must be callable',
            is_object($plugin) ? get_class($plugin) : gettype($plugin)
        ));
    }
}