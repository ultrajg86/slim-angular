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

	/*
	$view = $this->get('view');
	$arrayViewVar = array(
	    'baseUrl'   =>  $_SERVER['HTTP_HOST'],
		'title'	=>	'Project',
	);
	$view->setAttributes($arrayViewVar);
	*/

/*
	// add media parser
    $request->registerMediaTypeParser(
        "application/json",
        function ($input) {
            return json_decode($input, true);
        }
    );
*/

    $response = $next($request, $response);

    return $response;
});
