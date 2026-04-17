<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $fillable = ['type_id','price','card_width','card_height','quantity','description'];

    public function images()
    {
         return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class,'type_id');
    }

}
