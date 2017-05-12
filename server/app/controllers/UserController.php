<?php

namespace App\Controllers;

class UserController{

	private $container;
    private $logger;
    private $view;
    private $validator;

	public function __construct($container){
        $this->container = $container;
        $this->logger = $this->container->get('logger');
        //$this->view = $this->container->get('view');
        //$this->validator = $this->container->get('validator');
    }

	public function __destruct(){
        // TODO: Implement __destruct() method.
    }

	public function checkId($request, $response, $params){
		if($params['userid'] === 'admin'){
			return json_encode(array('result'=>'fail'));
		}else{
			return json_encode(array('result'=>'success'));
		}
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