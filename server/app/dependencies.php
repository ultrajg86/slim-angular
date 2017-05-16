<?php
/**
 * Created by PhpStorm.
 * User: 김종갑
 * Date: 2017-02-14
 * Time: 오후 3:59
 */

// Get container
$container = $app->getContainer();

//validator
$container['validator'] = function($container){
  return new \App\Validation\Validator();
};

//404
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page not found');
    };
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Service factory for the ORM
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// Register component on container
$container['view'] = function($container){
    return new \Slim\Views\PhpRenderer('pages');
};

//logging
$container['logger'] = function($container){
  $logger = new \Monolog\Logger('LOG');
  $file_handler = new \Monolog\Handler\StreamHandler('../logs/' . date('Y-m-d') . '.log');
  $logger->pushHandler($file_handler);
  return $logger;
};

require_once('dependencies/controllers.php');
require_once('dependencies/repositories.php');
require_once('dependencies/services.php');
