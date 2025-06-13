<?php

use App\Models\CartItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// use Auth;
class Helper
{

    // Total amount cart
    public static function totalCartPrice($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = Auth::user()->id;
            return \DB::table('cart_items')
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->where('cart_items.user_id', $user_id)
                ->selectRaw('SUM(cart_items.quantity * products.price) as total')
                ->value('total') ?? 0;
        } else {
            return 0;
        }
    }

    // Cart Count
    public static function cartCount($user_id = '')
    {

        if (Auth::check()) {
            if ($user_id == "") $user_id = Auth::user()->id;
            return CartItems::where('user_id', $user_id)->sum('quantity');
        } else {
            return 0;
        }
    }
}

if (!function_exists('generateUniqueSlug')) {
    /**
     * Generate a unique slug for a given title and model.
     *
     * @param string $title
     * @param string $modelClass
     * @return string
     */
    function generateUniqueSlug($title, $modelClass)
    {
        $slug = Str::slug($title);
        $count = $modelClass::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        return $slug;
    }
}
