<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

/*
 * template url : https://bootstrapmade.com/demo/Moderna/
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

require __DIR__ . '/../app/constants.php';

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/middleware.php';

require __DIR__ . '/../app/routes.php';

// Run app
$app->run();

?>