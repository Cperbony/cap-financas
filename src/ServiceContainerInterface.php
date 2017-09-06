<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 17/08/2017
 * Time: 12:16
 */
//TypeHintings no PHP 7
declare(strict_types=1);

namespace CAPFin;


interface ServiceContainerInterface
{
    public function add(string $name, $service);

    public function addLazy(string $name, callable $callable);

    public function get(string $name);

    public function has(string $name);
}
