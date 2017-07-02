<?php
/**
 * Created by PhpStorm.
 * User: 김종갑
 * Date: 2017-02-14
 * Time: 오전 10:45
 */

//middleware
$app->add(function ($request, $response, callable $next) {
    $route = $request->getAttribute('route');
    if (empty($route)) {
        throw new NotFoundException($request, $response);
    }

	$logger = $this->get('logger');
	$logger->info('asdfasdfasdfasdf');

	$view = $this->get('view');
	$arrayViewVar = array(
	    'baseUrl'   =>  $_SERVER['HTTP_HOST'],
		'title'	=>	'Project',
	);
	$view->setAttributes($arrayViewVar);

    $response = $next($request, $response);
	
	return $response;
});

$apiMw = function ($request, $response, $next) {
	$param = json_decode($request->getBody()->getContents(), true);
	$request = $request->withAttribute('param', $param);
	$view = $this->get('view');
	$view->setMimeType('json');
	$view->setResponse($response);
	$response = $next($request, $response);
    return $response;
};

$webMw = function ($request, $response, $next) {
    $request = $request->withAttribute('param', $_REQUEST);
	$view = $this->get('view');
	$view->setMimeType('html');
	$view->setResponse($response);
	$response = $next($request, $response);
    return $response;
};