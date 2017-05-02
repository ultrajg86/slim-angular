<?php

$this->get('/', function ($request, $response){
	return $this->view->render($response, '/main.php');
});

$this->get('/heroes', function ($request, $response){
	$array = array(
		array('id'=>1, 'name'=>'Mr.Nice')	
	);

	return json_encode($array);
});

$this->get('/test', function ($request, $response){
	return 'a';
});

?>