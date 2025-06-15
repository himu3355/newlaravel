<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategory;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    function home() {
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        return view('index',compact(['banners']));
    }
    function aboutus() {
        return view('frontend.pages.aboutus');
    }
    function contactus() {
        return view('frontend.pages.contactus');
    }
    function contactusstore(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string',
        ]);

        $contactus = ContactUs::create($validatedData);
        return redirect()->route('contactus')->with('success',"Your feedback submited.");
    }
    public function productList() {
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }

        $categories = AttributeCategory::where('active', true)
            ->where('filterable', true)
            ->orderBy('sort_order')
            ->with('attributes')
            ->get();

        // Get min and max price from filtered products (before pagination)
        $min_price = (clone $products)->min('price');
        $max_price = (clone $products)->max('price');


        // Sort by name , price, category
        return view('frontend.pages.products',compact(['products','categories','recent_products','min_price','max_price']));
    }

    public function productDetail($product) {
        $product_detail= Product::find($product);
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }
    public function filter(Request $request) {
        $query = Product::query()->where('status', 'active');

        // Filter by attributes if any were selected
        if ($request->has('attributes') && is_array($request['attributes'])) {
            foreach ($request['attributes'] as $attributeId) {
                $query->whereHas('attributes', function ($q) use ($attributeId) {
                    $q->orwhere('attributes.id', $attributeId);
                });
            }
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = AttributeCategory::where('active', true)
            ->where('filterable', true)
            ->orderBy('sort_order')
            ->with('attributes')
            ->get();
        $filter_atribs = $request['attributes'];

        // Get min and max price from filtered products (before pagination)
        $min_price = (clone $products)->min('price');
        $max_price = (clone $products)->max('price');
        return view('frontend.pages.products',compact(['products','categories','filter_atribs','min_price','max_price']));
    }

    public function cart() {
        return view('frontend.pages.cart');
    }

    public function checkout() {
        return view('frontend.pages.checkout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeorder(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'numeric|required',
            'city' => 'string|required',
            'region' => 'string|required',
            'address1' => 'string|required',
            'address2' => 'string|nullable',
            'coupon' => 'nullable|numeric',
            'post_code' => 'string|nullable',
        ]);
        // return $request->all();

        if (empty(CartItems::where('user_id', Auth::user()->id)->first())) {
            request()->session()->flash('error', 'Cart is Empty !');
            return back();
        }


        $order = new Order();
        $order_data = $request->all();
        unset($order_data['_token']);
        $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $order_data['user_id'] = $request->user()->id;
        $order_data['shipping_id'] = $request->shipping;
        $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
        $order_data['sub_total'] = Helper::totalCartPrice();
        $order_data['quantity'] = Helper::cartCount();
        if (session('coupon')) {
            $order_data['coupon'] = session('coupon')['value'];
        }
        if ($request->shipping) {
            if (session('coupon')) {
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0];
            }
        } else {
            if (session('coupon')) {
                $order_data['total_amount'] = Helper::totalCartPrice() - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice();
            }
        }
        // return $order_data['total_amount'];
        $order_data['status'] = "new";
        if (request('payment_method') == 'paypal') {
            $order_data['payment_method'] = 'paypal';
            $order_data['payment_status'] = 'Unpaid';
        } else {
            $order_data['payment_method'] = 'cod';
            $order_data['payment_status'] = 'Unpaid';
        }
        $order->fill($order_data);


        DB::beginTransaction();
        try {
            $status = $order->save();


            if (request('payment_method') == 'phonepe') {
                return redirect()->route('payment')->with(['id' => $order->id]);
            } else {
                // session()->forget('cart');
                // session()->forget('coupon');
            }


            // Create order items from cart items
            $cartItems = CartItems::where('user_id', Auth::user()->id)->get();

            // Create cart from cart items
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product->stock < $cartItem->quantity || $cartItem->product->stock <= 0) return back()->with('error', 'Stock not sufficient!.');
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'order_id' => $order->id,
                    'amount' => ($cartItem->product->price * $cartItem->quantity),
                ]);
            }

            // Delete cart items
            CartItems::where('user_id', Auth::user()->id)->delete();


            DB::commit();

            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
