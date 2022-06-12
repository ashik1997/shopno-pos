<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function subcategory(){
        return $this->belongsTo(ProductCategory::class, 'product_sub_category_id');
    }
    public function brand(){
        return $this->belongsTo(ProductBrand::class);
    }
}
