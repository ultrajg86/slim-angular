<?php

$this->get('/', function ($request, $response){
	return $this->view->render($response, '/main.php');
});

$this->get('/heroes', function ($request, $response){
	$array = array(
		array('id'=>1, 'name'=>'Mr.Nice')	
	);

	$ssss = '{"FAIL":"true","alert":"\uc0c1\ud488\uad8c\ubc1c\uae09\uc5d0 \uc2e4\ud328\ud588\uc2b5\ub2c8\ub2e4.","forwardURL":null}';

	var_dump($ssss);

	var_dump(json_decode($ssss));

	return json_encode($array);
});

$this->get('/test', function ($request, $response){
	return 'a';
});

?>