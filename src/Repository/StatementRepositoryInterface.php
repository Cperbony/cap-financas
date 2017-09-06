<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:41
 */

declare(strict_types=1);

namespace CAPFin\Repository;


interface StatementRepositoryInterface
{
    public function all(string $dateStart, string $dateEnd, int $userId): array;
}
