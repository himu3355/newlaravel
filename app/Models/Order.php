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
}
