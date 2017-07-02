<?php

$container['UserRepo'] = function($container){
	$userModel = new \App\Model\UserModel();
	return new \App\Repositories\UserRepo($userModel);
};

$container['TokenRepo'] = function($container){
	$tokenModel = new \App\Model\TokenModel();
	return new \App\Repositories\TokenRepo($tokenModel);
};