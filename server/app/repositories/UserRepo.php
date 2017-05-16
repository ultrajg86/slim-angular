<?php

namespace App\Repositories;

class UserRepo{

	private $userModel;

	public function __construct($userModel){
		$this->userModel = $userModel;
	}

	public function __destruct(){
	}

	public function find($userinfo = array()){
		if(empty($userinfo['userid']) === true ){
			return false;
		}

		//search userinfo
		return $userinfo;
	}

	public function fetchAll($page = 1, $limit = 10){
		$this->userModel->fetchAll();
	}

}