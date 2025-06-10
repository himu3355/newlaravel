<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeCategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::getAllProduct();
        return view('backend.product.index', compact('products'));
    }

    public function indexApi()
    {
        $products = Product::getAllProduct();
        $productArray = [];
        foreach ($products as $product) {
            $product = [
                "id" => $product->id,
                "category" => $product->cat_info->title,
                "type" => $product->condition,
                "name" => $product->title,
                "gender" => "women",
                "new" => $product->condition == 'new',
                "sale" => $product->condition == 'sale',
                "rate" => 4,
                "price" => $product->price,
                "originPrice" => 55,
                "brand" => $product->brand->title,
                "sold" => 12,
                "quantity" => $product->stock,
                "quantityPurchase" => 1,
                "sizes" => [
                    // "S",
                    // "M",
                    // "L",
                    // "XL"
                ],
                "variation" => [
                    // [
                    //     "color" => "red",
                    //     "colorCode" => "#DB4444",
                    //     "colorImage" => "./assets/images/product/color/48x48.png",
                    //     "image" => "./assets/images/product/1000x1000.png"
                    // ],
                    // [
                    //     "color" => "yellow",
                    //     "colorCode" => "#ECB018",
                    //     "colorImage" => "./assets/images/product/color/48x48.png",
                    //     "image" => "./assets/images/product/1000x1000.png"
                    // ]
                ],
                "thumbImage" =>  array_slice(explode(',',$product->photo),0,2),
                "images" => explode(',',$product->photo),
                "description" => $product->description,
                "action" => "quick shop",
                "slug" => $product->slug,
                'attributes' => $product->attributes->map(function ($attribute) {
                    return  $attribute->name;
                })->toArray(),
            ];
            $productArray[] = $product;
        }
        return response()->json(['success' => true, 'data' => $productArray, 'message' => 'Products retrieved successfully']);
    }

    public function showApi($slug) {

        $product = Product::getProductBySlug($slug);
        $productData = [
            "id" => $product->id,
            "category" => "fashion",
            "type" => $product->condition,
            "name" => $product->title,
            "gender" => "women",
            "new" => true,
            "sale" => false,
            "rate" => 4,
            "price" => $product->price,
            "originPrice" => 55,
            "brand" => $product->brand->title,
            "sold" => 12,
            "quantity" => $product->stock,
            "quantityPurchase" => 1,
            "sizes" => [],
            "variation" => [],
            "thumbImage" => explode(',',$product->photo),
            "images" => explode(',',$product->photo),
            "description" => $product->description,
            "action" => "quick shop",
            "slug" => $product->slug
        ];
        return response()->json(['success' => true, 'data' => $productData, 'message' => 'Products retrieved successfully']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        $attributesByCategory = $this->getAttributesByCategory();
        return view('backend.product.create', compact('categories', 'brands', 'attributesByCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'required|string',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,sale',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'attributes' => 'nullable|array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        $slug = generateUniqueSlug($request->title, Product::class);
        $validatedData['slug'] = $slug;
        $validatedData['is_featured'] = $request->input('is_featured', 0);

        if ($request->has('size')) {
            $validatedData['size'] = implode(',', $request->input('size'));
        } else {
            $validatedData['size'] = '';
        }

        $product = Product::create($validatedData);

        // Sync attributes
        if ($request->has('attributes')) {
            $product->attributes()->sync($request['attributes']);
        }

        $message = $product
            ? 'Product Successfully added'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $product ? 'success' : 'error',
            $message
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands = Brand::get();
        $product = Product::findOrFail($id);
        $categories = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        $attributesByCategory = $this->getAttributesByCategory();

        return view('backend.product.edit', compact('product', 'brands', 'categories', 'items', 'attributesByCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'required|string',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,sale',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'attributes' => 'nullable|array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        $validatedData['is_featured'] = $request->input('is_featured', 0);

        if ($request->has('size')) {
            $validatedData['size'] = implode(',', $request->input('size'));
        } else {
            $validatedData['size'] = '';
        }

        $status = $product->update($validatedData);

        // Sync attributes
        $product->attributes()->sync($request['attributes'] ?? []);

        $message = $status
            ? 'Product Successfully updated'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        $message = $status
            ? 'Product successfully deleted'
            : 'Error while deleting product';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    private function getAttributesByCategory()
    {
        $categories = AttributeCategory::where('active', true)
            ->orderBy('sort_order')
            ->with(['attributes' => function ($query) {
                $query->where('active', true)->orderBy('sort_order');
            }])
            ->get();

        $attributesByCategory = [];
        foreach ($categories as $category) {
            $attributesByCategory[$category->id] = [
                'name' => $category->name,
                'attributes' => $category->attributes,
            ];
        }

        return $attributesByCategory;
    }
}
