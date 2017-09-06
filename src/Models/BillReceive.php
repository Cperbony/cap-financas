<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 23/08/2017
 * Time: 12:23
 */

namespace CAPFin\Models;

use Illuminate\Database\Eloquent\Model;

class BillReceive extends Model
{
    //Mass Assignment (Atribuição Massiva)
    //Em vez de usar os SETs, pegamos um conjunto de dados e jogamos para o Modelo.
    protected $fillable = [
        'date_launch',
        'name',
        'value',
        'user_id'
    ];
}
