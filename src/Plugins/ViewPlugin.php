<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/08/2017
 * Time: 23:00
 */

namespace CAPFin\Plugins;

use CAPFin\ServiceContainerInterface;
use CAPFin\View\Twig\TwigGlobals;
use CAPFin\View\ViewRenderer;
use Interop\Container\ContainerInterface;


class ViewPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy(
            /**
            * @param ContainerInterface $container
            * @return Twig_Environment
            */
            'twig', function (ContainerInterface $container) {
                //Classe que carrega os templates da aplicação
                $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
                $twig = new \Twig_Environment($loader);

                $auth = $container->get('auth');

                $generator = $container->get('routing.generator');
                $twig->addExtension(new TwigGlobals($auth));
                $twig->addFunction(
                    new \Twig_SimpleFunction(
                        'route',
                        function (string $name, array $params = []) use ($generator) {
                            return $generator->generate($name, $params);
                        }
                    )
                );
                return $twig;
            }
        );

        //Recebe um container de serviços
        $container->addLazy(
            /**
            * @param ContainerInterface $container
            * @return ViewRenderer
            */
            'view.renderer', function (ContainerInterface $container) {
                //Pegar o twigEnvironmet
                /**
            * 
                 *
            * @var Twig_Environment $twigEnvironment 
            */
                $twigEnvironment = $container->get('twig');
                return new ViewRenderer($twigEnvironment);
            }
        );
    }
}
