<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 21/08/2017
 * Time: 14:22
 */
declare(strict_types=1);

use CAPFin\Application;
use CAPFin\Plugins\AuthPlugin;
use CAPFin\Plugins\DbPlugin;
use CAPFin\Plugins\RoutePlugin;
use CAPFin\Plugins\ViewPlugin;
use CAPFin\ServiceContainer;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

if(file_exists(__DIR__ . '/../.env')) {
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->overload();
}
require_once __DIR__ . '/../src/helpers.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

//Get Registra a Rota
//$app->get('/{name}', function (ServerRequestInterface $request) use ($app) {
//    //Pegar o serviço
//    $view = $app->service('view.renderer');
//    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
//    //TESTE
//    //var_dump($request->getUri()); die;
//    //echo "Hello World Lucas";
//});

//$app->get('/home', function () {
//    echo "Lucas em sua Home";
//});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    $response = new Zend\Diactoros\Response();
    $response->getBody()->write("Response com emitter do Diactoros");
    return $response;
    // TESTES // echo "Mostrando a Home do Lucas e Testando pegar os parâmetros";//echo "<br/>";
    // echo $request->getAttribute('name');// echo "<br/>";// echo $request->getAttribute('id');
});

require_once __DIR__ . '/../src/controllers/statements.php';
require_once __DIR__ . '/../src/controllers/charts.php';
require_once __DIR__ . '/../src/controllers/category-costs.php';
require_once __DIR__ . '/../src/controllers/users.php';
require_once __DIR__ . '/../src/controllers/auth.php';
require_once __DIR__ . '/../src/controllers/bill-receives.php';
require_once __DIR__ . '/../src/controllers/bill-pays.php';

$app->start();