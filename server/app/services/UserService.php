<?php

namespace App\Services;

class UserService{

	private $userRepo;
	
	public function __construct($container){
		$this->userRepo = $container['UserRepo'];
	}

	public function __destruct(){
	}

	public function check($checkUserId){
		$result = $this->userRepo->find(array('userid'=>$checkUserId));
		if($result === false){
			return array('result'=>true);
		}
		return array('result'=>false);
	}

	public function login(){//로그인처리 및 포인트지급
		//start transaction
		//logic
		//commit

		//login ok
		//jwt => json token
		return array('aaa'=>'bbbbbbb');
	}

}