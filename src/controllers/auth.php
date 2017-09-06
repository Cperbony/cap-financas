<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:25
 */


use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/login', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('auth/login.html.twig');
        }, 'auth.show_login_form'
    )
    ->post(
        /**
        * @param ServerRequestInterface $request
        * @return \Zend\Diactoros\Response\RedirectResponse
        */
        '/login', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            /**
        * 
             *
        * @var \CAPFin\Auth\Auth $auth 
        */
            $auth = $app->service('auth');
            $data = $request->getParsedBody();
            $result = $auth->login($data);
            if (!$result) {
                /**
        * 
                 *
        * @var $view 
        */
                return $view->render('auth/login.html.twig');
            }
            //retornar uma resposta, direcionando para a category-costs
            return $app->route('category-costs.list');
        }, 'auth.login'
    )
    ->get(
        '/logout', function () use ($app) {
            $app->service('auth')->logout();
            return $app->route('auth.show_login_form');
        }, 'auth.logout'
    );

$app->before(
    function () use ($app) {
        $route = $app->service('route');
        $auth = $app->service('auth');
        $routesWhiteList = [
        'auth.show_login_form',
        'auth.login'
        ];
        if (!in_array($route->name, $routesWhiteList) && !$auth->check()) {
            return $app->route('auth.show_login_form');
        }
    }
);

