<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'sub_total',
        'shipping_id',
        'coupon',
        'total_amount',
        'quantity',
        'payment_method',
        'payment_status',
        'status',
        'user_id',
        'shipping_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'post_code',
        'address1',
        'address2',
    ];

    
    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
