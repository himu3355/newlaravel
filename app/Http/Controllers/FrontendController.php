<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategory;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function home() {
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        return view('index',compact(['banners']));
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
        // Sort by name , price, category
        return view('frontend.pages.products',compact(['products','categories','recent_products']));
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
                    $q->where('attributes.id', $attributeId);
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
        return view('frontend.pages.products',compact(['products','categories','filter_atribs']));
    }
}
