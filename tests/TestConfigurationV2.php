<?php

return [
    'modules' => [
        'MonologModule',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__ . '/testing.config.php',
        ],
        'module_paths' => [],
    ],
];
