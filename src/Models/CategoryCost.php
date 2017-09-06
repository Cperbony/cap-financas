<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 23/08/2017
 * Time: 12:23
 */

namespace CAPFin\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCost extends Model
{
    //Mass Assignment (Atribuição Massiva)
    //Em vez de usar os SETs, pegamos um conjunto de dados e jogamos para o Modelo.
    protected $fillable = [
        'name',
        'user_id'
    ];
}
