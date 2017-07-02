<?php

$container['UserService'] = function ($container) {
    return new \App\Services\UserService($container);
};
