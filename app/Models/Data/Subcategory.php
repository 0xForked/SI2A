<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id'

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

    public function category()
    {
        return $this->belongsTo('App\Models\Data\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Data\Product');
    }

}