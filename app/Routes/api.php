<?php

$this->get('', function ($request, $response){
	return 'a';
});

$this->get('/testheroes', function ($request, $response){
	$array = array(
		array('id'=>1, 'name'=>'Mr.Nice1'),
		array('id'=>2, 'name'=>'Mr.Nice2'),
		array('id'=>3, 'name'=>'Mr.Nice3'),
		array('id'=>4, 'name'=>'Mr.Nice4'),
		array('id'=>5, 'name'=>'Mr.Nice5'),
	);

	return json_encode($array);
});


?>