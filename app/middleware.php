<?php

$app->add(function ($request, $response, callable $next) {
	
    $route = $request->getAttribute('route');
    if (empty($route)) {
        throw new NotFoundException($request, $response);
    }

	$name = $route->getName();
    $groups = $route->getGroups();
    $methods = $route->getMethods();
    $arguments = $route->getArguments();

	$view = $this->get('view');
	$arrayViewVar = array(
	    'baseUrl'   =>  $_SERVER['HTTP_HOST'],
		'title'	=>	'Project',
	);

	$view->setAttributes($arrayViewVar);
    $response = $next($request, $response);
    return $response;

});


/*

	//last ext
	$currentUrl = $request->getUri()->getPath();
	$currentUrlExplode = explode('/', $currentUrl);
	$lastUrl = $currentUrlExplode[count($currentUrlExplode) - 1];
	$posExt = strpos($lastUrl, '.');
	$currentContentType = 'html';
	if($posExt > 0){
		$currentUrl = substr($lastUrl, 0, $posExt);
		$currentContentType = substr($lastUrl, $posExt + 1);
	}
	
	$uri = new \Slim\Http\Uri('http', 'localhost');
	$uri->withPath($currentUrl);

	$routeInfo = $request->getAttribute('routeInfo');
	$routeInfo['request'][1] = 'http://localhost:8888/' . $currentUrl;

	$request = $request->withUri($uri);
*/
?>