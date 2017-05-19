<?php

namespace App\Services;

class UserService{

	private $userRepo;
	private $tokenRepo;
	
	public function __construct($container){
		$this->userRepo = $container['UserRepo'];
		$this->tokenRepo = $container['TokenRepo'];
	}

	public function __destruct(){
	}

	public function check($checkUserId){
		if(empty($checkUserId)){
			return false;
		}

		$result = $this->userRepo->find(array('user_id'=>$checkUserId));

		//$this->userRepo->create();

		if($result !== false && isset($result->user_id) == false){	//해당아이디가 없다면
			return array('result'=>true);
		}
		return array('result'=>false);
	}

	public function join($data){
		$result = $this->check($data['userid']);
		if($result['result'] !== true){
			return false;
		}
		$result = $this->userRepo->create($data);
	}

	public function login($userId, $userPwd){
		//start transaction
		//logic
		//commit

		$result = $this->userRepo->find(array('user_id'=>$userId, 'user_pwd'=>$userPwd));
		if(empty($result) || $result === false){
			return false;
		}

		//token
		$result = $this->tokenRepo->create($result->idx);

		return $result;
	}

	public function logout($userId){
		$result = $this->userRepo->find(array('user_id'=>$userId));
		if(empty($result) || $result === false){
			return false;
		}
		return $this->tokenRepo->delete($result->idx);
	}

	public function info($userId){
		$result = $this->userRepo->find(array('user_id'=>$userId));
		if(empty($result) || $result === false){
			return false;
		}
		return $result;
	}

	public function modify($data){		
		$result = $this->userRepo->modify($data);
		if(empty($result) || $result === false){
			return false;
		}
		return $result;
	}

}