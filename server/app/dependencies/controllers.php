<?php

//controller
$container['UserController'] = function ($container) {
    return new \App\Controllers\UserController($container);
};

$container['BoardController'] = function ($container) {
    return new \App\Controllers\BoardController($container);
};

