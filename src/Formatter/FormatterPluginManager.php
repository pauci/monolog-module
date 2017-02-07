<?php

namespace MonologModule\Formatter;

use Monolog\Formatter;
use Monolog\Formatter\FormatterInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Factory\InvokableFactory;

class FormatterPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    protected $aliases = [
        'chromephp'   => Formatter\ChromePHPFormatter::class,
        'elastica'    => Formatter\ElasticaFormatter::class,
        'flowdock'    => Formatter\FlowdockFormatter::class,
        'gelfmessage' => Formatter\GelfMessageFormatter::class,
        'html'        => Formatter\HtmlFormatter::class,
        'json'        => Formatter\JsonFormatter::class,
        'line'        => Formatter\LineFormatter::class,
        'loggly'      => Formatter\LogglyFormatter::class,
        'logstash'    => Formatter\LogstashFormatter::class,
        'normalizer'  => Formatter\NormalizerFormatter::class,
        'scalar'      => Formatter\ScalarFormatter::class,
        'wildfire'    => Formatter\WildfireFormatter::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $factories = [
        Formatter\ChromePHPFormatter::class   => InvokableFactory::class,
        Formatter\ElasticaFormatter::class    => Service\ElasticaFormatterFactory::class,
        Formatter\FlowdockFormatter::class    => Service\FlowdockFormatterFactory::class,
        Formatter\GelfMessageFormatter::class => Service\GelfMessageFormatterFactory::class,
        Formatter\HtmlFormatter::class        => Service\HtmlFormatterFactory::class,
        Formatter\JsonFormatter::class        => Service\JsonFormatterFactory::class,
        Formatter\LineFormatter::class        => Service\LineFormatterFactory::class,
        Formatter\LogglyFormatter::class      => Service\LogglyFormatterFactory::class,
        Formatter\LogstashFormatter::class    => Service\LogstashFormatterFactory::class,
        Formatter\NormalizerFormatter::class  => Service\NormalizerFormatterFactory::class,
        Formatter\ScalarFormatter::class      => Service\ScalarFormatterFactory::class,
        Formatter\WildfireFormatter::class    => Service\WildfireFormatterFactory::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $sharedByDefault = false;

    /**
     * {@inheritDoc}
     */
    protected $instanceOf = FormatterInterface::class;
}
