<?php

use App\Utility\LanguageUtility;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->add(function (Request $request, Response $response, callable $next) {
    $route = $request->getAttribute('route');
    
    // return NotFound for non existent route
//    if (empty($route)) {
//        throw new NotFoundException($request, $response);
//    }
    
    if (!empty($route)) {
        $name = $route->getName();
        #$groups = $route->getGroups();
        #$methods = $route->getMethods();
        $arguments = $route->getArguments();

        // information for twig extension
        $_SESSION['route'] = $name;
        $_SESSION['route-args'] = $arguments;

        LanguageUtility::languageDetection($name, $arguments);
    }
    
    return $next($request, $response);
});

// initialize all routes from all languages
foreach ($settings['settings']['locale']['active'] as $activeLocale) {
    // if translation file exists, load file to $locale
    if (is_readable($settings['settings']['locale']['path'] . $activeLocale . '.php')) {
        $tempLocale = require $settings['settings']['locale']['path'] . $activeLocale . '.php';
        $suffixName = '-' . strtolower($activeLocale);

        
        $app->post($tempLocale['user-login-validate'], 'App\Controller\UserController:loginValidate')->setName('user-login-validate' . $suffixName);
        $app->get($tempLocale['user-login-success'], 'App\Controller\UserController:loginSuccess')->setName('user-login-success' . $suffixName);
        $app->get($tempLocale['user-logout'], 'App\Controller\UserController:logout')->setName('user-logout' . $suffixName);
        $app->get($tempLocale['user-login'], 'App\Controller\UserController:login')->setName('user-login' . $suffixName);
        $app->get($tempLocale['page-example'], 'App\Controller\PageController:example')->setName('page-example' . $suffixName);
        // insert new links above page index
        $app->get($tempLocale['page-index'], 'App\Controller\PageController:index')->setName('page-index' . $suffixName);
    }
}