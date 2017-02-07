<?php

namespace MonologModule\Formatter;

use Monolog\Formatter;
use Monolog\Formatter\FormatterInterface;
use MonologModule\Exception;
use Zend\ServiceManager\AbstractPluginManager;

class FormatterPluginManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    protected $invokableClasses = [
        'chromephp' => Formatter\ChromePHPFormatter::class,
    ];

    /**
     * @var array
     */
    protected $factories = [
        'elastica'    => Service\ElasticaFormatterFactory::class,
        'flowdock'    => Service\FlowdockFormatterFactory::class,
        'gelfmessage' => Service\GelfMessageFormatterFactory::class,
        'html'        => Service\HtmlFormatterFactory::class,
        'json'        => Service\JsonFormatterFactory::class,
        'line'        => Service\LineFormatterFactory::class,
        'loggly'      => Service\LogglyFormatterFactory::class,
        'logstash'    => Service\LogstashFormatterFactory::class,
        'normalizer'  => Service\NormalizerFormatterFactory::class,
        'scalar'      => Service\ScalarFormatterFactory::class,
        'wildfire'    => Service\WildfireFormatterFactory::class,
    ];

    /**
     * Allow many formatters of same type
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * Validate the plugin
     *
     * Checks that the handler is an instance of FormatterInterface
     *
     * @param  mixed $plugin
     * @throws Exception\InvalidArgumentException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof FormatterInterface) {
            return; // we're okay
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement %s',
            is_object($plugin) ? get_class($plugin) : gettype($plugin),
            FormatterInterface::class
        ));
    }
}
