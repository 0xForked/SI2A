<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'product_id',
        'name',
        'qty',
        'price',
        'disc',
        'net',
        'tax',
        'total'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Data\Product');
    }
}
