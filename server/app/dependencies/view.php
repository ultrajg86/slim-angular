<?php



/*
$container['view'] = function ($container) {
    //$view = new \Slim\Views\Twig('pages', ['cache' => 'cache']);
    $view = new \Slim\Views\Twig('pages', [
        'debug' => true,
        'cache' => false
    ]);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
//    $view->addExtension(new \Slim\Views\TwigExtension(
//        $container->router,
//        $container->request->getUri()
//    ));
//    $view->addExtension(new Twig_Extension_Debug());
    //hm.....
    $view->getEnvironment()->addGlobal('base_url', _HOST_);
    return $view;
};
*/

