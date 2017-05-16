<?php

namespace App\Controllers;

use App\Repositories\UserRepo;

class UserController{

	private $container;
    private $logger;
    private $view;
    private $validator;

	private $userService;

	public function __construct($container){
        $this->container = $container;
        $this->logger = $this->container->get('logger');
        //$this->view = $this->container->get('view');
        //$this->validator = $this->container->get('validator');

		$this->userService = $container['UserService'];
    }

	public function __destruct(){
        // TODO: Implement __destruct() method.
    }

	public function check($request, $response, $params){
		/*
		if($params['userid'] === 'admin'){
			return json_encode(array('result'=>'fail'));
		}else{
			return json_encode(array('result'=>'success'));
		}
		*/

		$data = $this->userService->check($params['userid']);
		return $response->withJson($data);
	}

	public function login($request, $response, $params){
		$jsonData = json_decode($request->getBody()->getContents());
		if(empty($jsonData->userid) === false && $jsonData->userid === 'admin'){
			return json_encode(array('result'=>'success'));
		}else{
			return json_encode(array('result'=>'fail'));
		}
	}

	public function logout($request, $response, $params){
		if($params['userid'] === 'admin'){
			return json_encode(array('result'=>'success'));
		}else{
			return json_encode(array('result'=>'fail'));
		}
	}

	public function join($request, $response, $params){
		$joinData = json_decode($request->getBody()->getContents());
		var_dump($joinData);
	}

	public function info($request, $response, $params){
		var_dump($params);
		if($params['userid'] === 'admin'){
			return json_encode(array('result'=>'success'));
		}else{
			return json_encode(array('result'=>'fail'));
		}
	}

	public function modify($request, $response, $params){
		if($params['userid'] === 'admin'){
			return json_encode(array('result'=>'success'));
		}else{
			return json_encode(array('result'=>'fail'));
		}
	}

}