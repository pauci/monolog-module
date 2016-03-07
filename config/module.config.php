<?php

use Monolog\Formatter;

return [
    'monolog_error_handler' => [
        'enabled' => false,
    ],

    'monolog' => [
        'logger' => [
            'default' => [
                'name'       => 'default',
                'tags'       => [],
                'processors' => [],
                'handlers'   => [],
            ],
        ],

        'processor' => [
            'git'             => [],
            'introspection'   => [],
            'memorypeakusage' => [],
            'memoryusage'     => [],
            'processid'       => [],
            'psrlog'          => [],
            'tag'             => [],
            'uid'             => [],
            'web'             => [],
        ],

        'handler' => [
            'browserconsole' => [],
            'chromephp'      => [],
            'elasticsearch'  => [],
            'fingerscrossed' => [],
            'firephp'        => [],
            'null'           => [],
            'redis'          => [],
            'stream'         => [],
        ],

        'formatter' => [
            'chromephp'   => [],
            'elastica'    => [],
            'flowdock'    => [],
            'gelfmessage' => [],
            'html'        => [],
            'json'        => [],
            'line'        => [],
            'loggy'       => [],
            'logstash'    => [],
            'normalizer'  => [],
            'scalar'      => [],
            'wildfire'    => [],
        ],
    ],

    'monolog_factories' => [
        'logger'    => MonologModule\Service\LoggerFactory::class,
        'processor' => MonologModule\Service\ProcessorFactory::class,
        'handler'   => MonologModule\Service\HandlerFactory::class,
        'formatter' => MonologModule\Service\FormatterFactory::class,
    ],

    'service_manager' => [
        'invokables' => [
        ],
        'factories' => [
            MonologModule\Processor\ProcessorPluginManager::class => MonologModule\Service\PluginManagerFactory::class,
            MonologModule\Handler\HandlerPluginManager::class     => MonologModule\Service\PluginManagerFactory::class,
            MonologModule\Formatter\FormatterPluginManager::class => MonologModule\Service\PluginManagerFactory::class,

        ],
        'abstract_factories' => [
            'Monolog' => MonologModule\ServiceFactory\AbstractLoggerFactory::class,
        ],
    ],
];
