<?php

header( 'Access-Control-Allow-Origin: *' );
/*
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
header( "Access-Control-Allow-Headers: X-AMZ-META-TOKEN-ID, X-AMZ-META-TOKEN-SECRET, Content-Type, Accept" );
*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$settings = require './app/settings.php';

$app = new \Slim\App($settings);

require './app/constants.php';

require './app/dependencies.php';

require './app/middleware.php';

require './app/route.php';

$app->run();