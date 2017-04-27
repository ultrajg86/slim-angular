<?php

$app->group('', function(){
	require_once('Routes/public.php');
});

$app->group('/admin', function(){
	require_once('Routes/admin.php');
});

$app->group('/api', function(){
	require_once('Routes/api.php');
});

?>