<?php
/**
 * Created by PhpStorm.
 * User: 김종갑
 * Date: 2017-02-17
 * Time: 오전 10:05
 */
//HOST
defined('_HOST_')     OR define('_HOST_', 'http://' . $_SERVER['HTTP_HOST']);
defined('DOCUMENT_ROOT')     OR define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
defined('SERVICE_PATH')     OR define('SERVICE_PATH', DOCUMENT_ROOT . '/../service');
defined('MODEL_PATH')     OR define('MODEL_PATH', DOCUMENT_ROOT . '/../model');
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
defined('DIR_ALL_MODE')    OR define('DIR_ALL_MODE', 0777);
defined('UPLOAD_ROOT')     OR define('UPLOAD_ROOT', __DIR__);


//Status Code
defined('_STATUS_CODE_')     OR define('_STATUS_CODE_', __DIR__);