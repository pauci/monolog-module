<?php

use Monolog\Formatter;

return [
    'monolog' => [
        'logger' => [
            'default' => [
                'name'       => 'default',
                'tags'       => [],
                'processors' => [],
                'handlers'   => [],
            ]
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
            MonologModule\Processor\ProcessorPluginManager::class => MonologModule\Processor\ProcessorPluginManager::class,
            MonologModule\Handler\HandlerPluginManager::class     => MonologModule\Handler\HandlerPluginManager::class,
            MonologModule\Formatter\FormatterPluginManager::class => MonologModule\Formatter\FormatterPluginManager::class,
        ],
        'abstract_factories' => [
            'Monolog' => MonologModule\ServiceFactory\AbstractLoggerFactory::class,
        ],
    ],
];
