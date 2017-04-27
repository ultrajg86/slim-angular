<?php

$this->get('/', function ($request, $response){
	return $this->view->render($response, '/main.php');
});

$this->get('/test', function ($request, $response){
	return 'a';
});

?>