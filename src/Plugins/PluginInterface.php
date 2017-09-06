<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 17/08/2017
 * Time: 13:05
 */

namespace CAPFin\Plugins;


use CAPFin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}
