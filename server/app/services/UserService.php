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
		if(empty($checkUserId)){
			return true;
		}

		$result = $this->userRepo->find(array('userid'=>$checkUserId));

		if(isset($result->user_id) == false){	//해당아이디가 없다면
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