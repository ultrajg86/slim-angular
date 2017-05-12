<?php

$app->group('/admin', function(){

	$this->get('', function($request, $response, $args){
		echo 'admin';
	});

});
