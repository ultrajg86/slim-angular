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
		$data = $this->userService->check($params['userid']);
		if($data === false){
			return $response->withStatus(204);
		}
		return $response->withJson($data);
	}

	public function login($request, $response, $params){
		$params = $request->getAttribute('param');
		foreach($params as $key=>$value){
			if(empty($value)){
				return $response->withJson(array('result'=>false));
			}
		}
		$data = $this->userService->login($params['userid'], $params['userpwd']);
		if($data === false){
			$data = array('result'=>false);
			return $response->withJson($data);
		}
		$data['result'] = true;
		return $response->withJson($data);
	}

	public function logout($request, $response, $params){
		$params = $request->getAttribute('param');
		$data = $this->userService->logout($params['userid']);
		if($data === false){
			$data = array('result'=>false);
			return $response->withJson($data);
		}
		$data = array('result'=>true);
		return $response->withJson($data);
	}

	public function join($request, $response, $params){
		$data = json_decode($request->getBody()->getContents(), true);
		$result = $this->userService->join($data);
		if($result === false){
			$data = array('result'=>false);
			return $response->withJson($data);
		}
		$data['result'] = true;
		return $response->withJson($data);
	}

	public function info($request, $response, $params){
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