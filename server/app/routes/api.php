<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function(){

	$this->get('/login/{userid}', 'UserController:login');

	//$this->post('/login', 'UserController:login');
	$this->post('/login', function(Request $request, Response $response, $args){
		var_dump($request->getParsedBody());
		var_dump($request->getBody());
	});

});
