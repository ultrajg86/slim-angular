<?php

namespace App\Repositories;

class TokenRepo{

	private $tokenModel;

	public function __construct($tokenModel){
		$this->tokenModel = $tokenModel;
	}

	public function __destruct(){
	}

	public function create($userIdx){
		if(is_numeric($userIdx) === false || $userIdx < 1){
			return false;
		}

		//기존토큰 전체 삭제 - 삭제갯수가 필요가없음
		$this->delete($userIdx);
		

		//토큰새로발급
		$newToken = $this->createToken();
		$newExpireDate = date('Y-m-d H:i:s', time() + 86000);
		$data = array('users_idx'=>$userIdx, 'user_token'=>$newToken, 'expire_date'=>$newExpireDate);
		$result = $this->tokenModel->join($data);
		if($result !== true){
			return false;
		}

		//새로발급된 토큰 리턴
		return $data;
	}

	public function fetchAll($page = 1, $limit = 10){
		$this->userModel->fetchAll();
	}

	public function delete($userIdx){
		$deleteRows = $this->tokenModel->where('users_idx', $userIdx)->delete();
		return $deleteRows;
	}

	//create new token
	private function createToken(){
		return uniqid();	
	}

}