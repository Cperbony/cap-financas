<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 23:31
 */
declare(strict_types=1);

namespace CAPFin\Repository;


class RepositoryFactory
{
    public static function factory(string $modelClass)
    {
        return new DefaultRepository($modelClass);
    }
}
