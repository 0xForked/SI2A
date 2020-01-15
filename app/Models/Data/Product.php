<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'image',
        'stock',
        'bets_number',
        'marketing_authorization_number',
        'expired_date',
        'name',
        'price',
        'unit_id',
        'subcategory_id',
        'status'
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

    public function unit()
    {
        return $this->belongsTo('App\Models\Data\Unit');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Data\Subcategory');
    }

    public function modifiedHistories()
    {
        return $this->hasMany('App\Models\Data\ProductModifiedHistory')
                    ->orderBy('created_at', 'desc')
                    ->limit(6);
    }
}