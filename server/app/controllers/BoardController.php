<?php

namespace App\Controllers;

class BoardController{

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

	public function lists($request, $response, $params){
		$joinData = json_decode($request->getBody()->getContents());
		var_dump($joinData, $params);
	}

	public function views($request, $response, $params){
		$joinData = json_decode($request->getBody()->getContents());
		var_dump($joinData, $params);
	}

	public function delete($request, $response, $params){
		$joinData = json_decode($request->getBody()->getContents());
		var_dump($joinData, $params);
	}

	public function modify($request, $response, $params){
		$joinData = json_decode($request->getBody()->getContents());
		var_dump($joinData, $params);
	}

}