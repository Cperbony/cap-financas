<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:41
 */

declare(strict_types=1);

namespace CAPFin\Repository;


use Psr\Http\Message\ResponseInterface;

interface CategoryCostRepositoryInterface extends ResponseInterface
{
    public function sumByPeriod(string $dateStart, string $dateEnd, int $userId): array;
}
