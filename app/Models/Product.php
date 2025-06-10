<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','price','brand_id','discount','status','photo','size','stock','is_featured','condition'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info','attributes'])->orderBy('id','desc')->paginate(10);
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public static function getProductBySlug($slug){
        return Product::with(['cat_info'])->where('slug',$slug)->first();
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute');
    }

    public function getAttributesByCategory($categorySlug)
    {
        return $this->attributes()
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->get();
    }

    // public function hasAttribute($attributeId)
    // {
    //     return $this->attributes()->where('attributes.id', $attributeId)->exists();
    // }
}
