<?php

use MonologModuleTest\ServiceManagerFactory;

ini_set('error_reporting', E_ALL | E_STRICT);


if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $loader = require __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    $loader = require __DIR__ . '/../../../autoload.php';
} else {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/** @var \Composer\Autoload\ClassLoader $loader */
$loader->add('MonologModuleTest', __DIR__);
unset($loader);


if (file_exists(__DIR__ . '/configuration.php')) {
    $config = require __DIR__ . '/configuration.php';
} else {
    $config = require __DIR__ . '/configuration.php.dist';
}

ServiceManagerFactory::setConfig($config);
unset($config);
