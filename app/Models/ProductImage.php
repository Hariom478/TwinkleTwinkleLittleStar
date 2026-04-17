<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function getImageAttribute($config)
    {
        if(!empty($config))
        {
            return asset('storage/'.$config) ;
        }else{

        return ;

        }
    }
}
