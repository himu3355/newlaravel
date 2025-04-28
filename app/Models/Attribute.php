<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $casts = [
        'meta_data' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(AttributeCategory::class, 'attribute_category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute');
    }
}
