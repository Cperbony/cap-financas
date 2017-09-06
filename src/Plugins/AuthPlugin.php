<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/08/2017
 * Time: 23:00
 */

namespace CAPFin\Plugins;

use CAPFin\Auth\Auth;
use CAPFin\Auth\JasnyAuth;
use CAPFin\ServiceContainerInterface;
use Interop\Container\ContainerInterface;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy(
            'jasny.auth', function (ContainerInterface $container) {
                return new JasnyAuth($container->get('user.repository'));

            }
        );
        $container->addLazy(
            'auth', function (ContainerInterface $container) {
                return new Auth($container->get('jasny.auth'));
            }
        );
    }
}
