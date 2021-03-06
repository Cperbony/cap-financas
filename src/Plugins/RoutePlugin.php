<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 21/08/2017
 * Time: 13:52
 */
declare(strict_types=1);

namespace CAPFin\Plugins;

use Aura\Router\RouterContainer;
use Interop\Container\ContainerInterface;
use CAPFin\ServiceContainerInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;

class RoutePlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();
        /* Registrar as Rotas da Aplicação*/
        $map = $routerContainer->getMap();
        /* Função de Identificar a Rota que esta sendo acessada */
        $matcher = $routerContainer->getMatcher();
        /* Gerar Links com Base nas Rotas Registradas*/
        $generator = $routerContainer->getGenerator();
        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy(
            'route', function (ContainerInterface $container) {
                $matcher = $container->get('routing.matcher');
                $request = $container->get(RequestInterface::class);
                return $matcher->match($request);
            }
        );
    }

    /* Passar todas as variáveis globais para o método getRequest*/
    protected function getRequest(): RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}
