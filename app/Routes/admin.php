<?php

$this->get('', function ($request, $response){
	return 'a';
});

$this->get('/test', function ($request, $response){
	return 'aasdfasdf';
});

?>