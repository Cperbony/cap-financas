<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/08/2017
 * Time: 23:00
 */

namespace CAPFin\Plugins;

use CAPFin\Models\BillPay;
use CAPFin\Models\BillReceive;
use CAPFin\Models\CategoryCost;
use CAPFin\Models\User;
use CAPFin\Repository\CategoryCostRepository;
use CAPFin\Repository\RepositoryFactory;
use CAPFin\Repository\StatementRepository;
use CAPFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Interop\Container\ContainerInterface;

class DbPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());
        $container->addLazy(
            'category-cost.repository', function () {
                return new CategoryCostRepository();
            }
        );

        $container->addLazy(
            'bill-receives.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillReceive::class);
            }
        );

        $container->addLazy(
            'bill-pays.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillPay::class);
            }
        );

        $container->addLazy(
            'user.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(User::class);
            }
        );

        $container->addLazy(
            'statement.repository', function () {
                return new StatementRepository();
            }
        );
    }
}
