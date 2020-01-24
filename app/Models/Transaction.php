<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref_no',
        'letter_no',
        'note',
        'brutto',
        'disc',
        'netto',
        'tax',
        'total',
        'pay',
        'recipient_id',
        'customer_id',
        'type',
        'status',
        'assign_by'
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


    public function items()
    {
        return $this->hasMany('App\Models\TransactionItem');
    }
}
