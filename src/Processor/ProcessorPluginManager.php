<?php

namespace MonologModule\Processor;

use Monolog\Processor;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\Factory\InvokableFactory;

class ProcessorPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    protected $aliases = [
        'git'             => Processor\GitProcessor::class,
        'introspection'   => Processor\IntrospectionProcessor::class,
        'memorypeakusage' => Processor\MemoryPeakUsageProcessor::class,
        'memoryusage'     => Processor\MemoryUsageProcessor::class,
        'processid'       => Processor\ProcessIdProcessor::class,
        'psrlogmessage'   => Processor\PsrLogMessageProcessor::class,
        'tag'             => Processor\TagProcessor::class,
        'uid'             => Processor\UidProcessor::class,
        'web'             => Processor\WebProcessor::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $factories = [
        Processor\GitProcessor::class             => Service\GitProcessorFactory::class,
        Processor\IntrospectionProcessor::class   => Service\IntrospectionProcessorFactory::class,
        Processor\MemoryPeakUsageProcessor::class => Service\MemoryPeakUsageProcessorFactory::class,
        Processor\MemoryUsageProcessor::class     => Service\MemoryUsageProcessorFactory::class,
        Processor\ProcessIdProcessor::class       => InvokableFactory::class,
        Processor\PsrLogMessageProcessor::class   => InvokableFactory::class,
        Processor\TagProcessor::class             => Service\TagProcessorFactory::class,
        Processor\UidProcessor::class             => Service\UidProcessorFactory::class,
        Processor\WebProcessor::class             => Service\WebProcessorFactory::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $sharedByDefault = false;

    /**
     * {@inheritDoc}
     */
    public function validate($instance)
    {
        if (is_callable($instance)) {
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Plugin manager "%s" expected an instance of type "%s", but "%s" was received',
            __CLASS__,
            $this->instanceOf,
            is_object($instance) ? get_class($instance) : gettype($instance)
        ));
    }
}
