<?php

return [
    'modules' => [
        //'Zend\Mvc\Console',
        'Zend\Router',
        'MonologModule',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__ . '/testing.config.php',
        ],
        'module_paths' => [],
    ],
];
