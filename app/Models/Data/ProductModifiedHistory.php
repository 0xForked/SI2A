<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class ProductModifiedHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'before',
        'after',
        'user_id'
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


    public function product()
    {
        return $this->belongsTo('App\Models\Data\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}