<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:44
 */
declare(strict_types=1);

namespace CAPFin\Repository;

use CAPFin\Models\BillPay;
use CAPFin\Models\BillReceive;
use Illuminate\Support\Collection;

class StatementRepository implements StatementRepositoryInterface
{

    public function all(string $dateStart, string $dateEnd, int $userId): array
    {
        //Pegar as Contas a Pagar -> Contabilizar as contas a pagar
        //Pegar as Contas a Receber -> Contabilizar as contas a receber
        //Juntar e Contabilizar contas pagas e recebidas.

        $billPays = BillPay::query()
            ->selectRaw('bill_pays.*, category_costs.name as category_name')
            ->leftJoin('category_costs', 'category_costs.id', '=', 'bill_pays.category_cost_id')
            ->whereBetween('date_launch', [$dateStart, $dateEnd])
            ->where('bill_pays.user_id', $userId)
            ->get();

        $billReceives = BillReceive::query()
            ->whereBetween('date_launch', [$dateStart, $dateEnd])
            ->where('user_id', $userId)
            ->get();

        //Collection [0 => BillPay1, 1 => BillPay2...]
        //Collection [0 => BillReceives1, 1 => BillReceives2...]
        //No PHP no método array_merge_recursive() não olha somente a chave, mas também o valor, não somente o indíce.
        $collection = new Collection(array_merge_recursive($billPays->toArray(), $billReceives->toArray()));
        $statements = $collection->sortByDesc('date_launch');
        return [
            'statements' => $statements,
            'total_pays' => $billPays->sum('value'),
            'total_receives' => $billReceives->sum('value')
        ];
    }
}
