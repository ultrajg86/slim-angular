<?php

$container['UserRepo'] = function($container){
	$userModel = new \App\Model\UserModel();
	return new \App\Repositories\UserRepo($userModel);
};