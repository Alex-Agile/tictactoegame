<?php

// Class autoload
require dirname(dirname(__FILE__)) . '/bootstrap.php';

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

session_start();

// Define app environment
if (empty($_ENV['APP_ENV'])) {
    $_ENV['APP_ENV'] = (getenv('APP_ENV')) ? getenv('APP_ENV') : 'development';
}

// Load app settings
$settings = \Docler\App\Config\SettingsStore::getSettings($_ENV['APP_ENV']);

// Instantiate the app
$app = new \Slim\App($settings);

// Set up dependencies
(new \Docler\App\Dependency\DependencyLoader())($app);

// Register middleware
(new \Docler\App\Middleware\MiddlewareLoader())($app);

// Register routes
(new \Docler\App\Route\RouteLoader())($app);

// Run app
$app->run();
