<?php

namespace App\Repositories;

class UserRepo{

	private $userModel;

	public function __construct($userModel){
		$this->userModel = $userModel;
	}

	public function __destruct(){
	}

	public function find($data = array()){

		foreach($data as $key=>$value){
			if(in_array($key, $this->userModel->fillable) === false){
				return false;
			}
		}

		//$data = $this->userModel->find('1');
		$user = $this->userModel->info($data);

		return $user;
	}

	public function create($data){
		$data = array(
			'user_id'=>$data['userid'],
			'user_pwd'=>$data['userpwd'],
			'user_name'=>$data['username'],
			'user_perm'=>$data['userperm'],
			'reg_date' => date('Y-m-d H:i:s')
		);

		foreach($data as $key=>$value){
			if(in_array($key, $this->userModel->fillable) === false){
				return false;
			}
		}

		//$user = $this->userModel->create($data);
		return $this->userModel->join($data);
	}

	public function fetchAll($page = 1, $limit = 10){
		$this->userModel->fetchAll();
	}

	public function modify($data=array()){
		if(count($data) < 1){
			return false;
		}

		$params = array(
			'user_name'	=>	isset($data['username']) ? $data['username'] : '',
			'user_pwd'	=>	isset($data['userpwd']) ? $data['userpwd'] : '',
			'user_perm'	=>	isset($data['userperm']) ? $data['userperm'] : '',
		);
		$where = array('user_id'=>$data['userid']);
		return $this->userModel->modify($params, $where);

	}

}