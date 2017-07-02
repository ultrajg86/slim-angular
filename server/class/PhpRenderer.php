<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017-07-03
 * Time: 오전 12:14
 */

namespace App\PhpRenderer;

class PhpRenderer extends \Slim\Views\PhpRenderer{

    private $mimeType = 'html';
    private $response;

    public function setMimeType($mimeType = 'html'){
        $this->mimeType = $mimeType;
    }

    public function setResponse($response){
        $this->response = $response;
    }

    public function protectedIncludeScope($template, array $data){
        if($this->mimeType === 'json'){
            echo $this->response->withJson($data);
        }else{
            parent::protectedIncludeScope($template, $data);
        }
    }

}