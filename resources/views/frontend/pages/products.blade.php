@extends('layouts.frontend.app')

@section('extra-css')
<style>
    @media (min-width: 1024px) {
        .product-item:hover.grid-type .product-main .product-infor .product-name {
            opacity: 1;
            visibility: visible;
        }

        .product-item:hover.grid-type .product-main .product-infor .product-price-block {
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')

<div class="breadcrumb-block style-img">
    <div class="breadcrumb-main bg-linear overflow-hidden">
        <div class="container lg:pt-[134px] pt-24 pb-10 relative">
            <div class="main-content w-full h-full flex flex-col items-center justify-center relative z-[1]">
                <div class="text-content">
                    <div class="heading2 text-center">Shop</div>
                    <div class="link flex items-center justify-center gap-1 caption1 mt-3">
                        <a href="{{ route('home') }}">Homepage</a>
                        <i class="ph ph-caret-right text-sm text-secondary2"></i>
                        <div class="text-secondary2 capitalize">Shop</div>
                    </div>
                </div>
                {{-- <div class="filter-type menu-tab flex flex-wrap items-center justify-center gap-y-5 gap-8 lg:mt-[70px] mt-12 overflow-hidden">
                    <div class="item tab-item text-button-uppercase cursor-pointer has-line-before line-2px" data-item="t-shirt">t-shirt</div>
                    <div class="item tab-item text-button-uppercase cursor-pointer has-line-before line-2px" data-item="dress">dress</div>
                    <div class="item tab-item text-button-uppercase cursor-pointer has-line-before line-2px" data-item="top">top</div>
                    <div class="item tab-item text-button-uppercase cursor-pointer has-line-before line-2px" data-item="swimwear">swimwear</div>
                    <div class="item tab-item text-button-uppercase cursor-pointer has-line-before line-2px" data-item="shirt">shirt</div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div class="shop-product breadcrumb1 lg:py-20 md:py-14 py-10">
    <div class="container">
        <div class="flex max-md:flex-wrap max-md:flex-col-reverse gap-y-8">
            <div class="sidebar lg:w-1/4 md:w-1/3 w-full md:pr-12">
                <form action="{{ route('products.filter') }}" method="GET">
                    <!-- <div class="filter-type-block pb-8 border-b border-line">
                        <div class="heading6">Products Type</div>
                        <div class="list-type filter-type menu-tab mt-4">
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="t-shirt">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">t-shirt</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="dress">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">dress</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="top">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">top</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="swimwear">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">swimwear</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="shirt">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">shirt</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="underwear">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">underwear</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="sets">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">sets</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                            <div class="item tab-item flex items-center justify-between cursor-pointer" data-item="accessories">
                                <div class="type-name text-secondary has-line-before hover:text-black capitalize">accessories</div>
                                <div class="text-secondary2 number">6</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="filter-size pb-8 border-b border-line mt-8">
                    <div class="heading6">Size</div>
                    <div class="list-size flex items-center flex-wrap gap-3 gap-y-4 mt-4">
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="XS">XS</div>
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="S">S</div>
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="M">M</div>
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="L">L</div>
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="XL">XL</div>
                        <div class="size-item text-button w-[44px] h-[44px] flex items-center justify-center rounded-full border border-line" data-item="2XL">2XL</div>
                        <div class="size-item text-button px-4 py-2 flex items-center justify-center rounded-full border border-line" data-item="freesize">Freesize</div>
                    </div>
                </div> -->
                    <div class="filter-price pb-8 border-b border-line mt-8">
                        <div class="heading6">Price Range</div>
                        <div class="tow-bar-block mt-5">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input class="range-min" type="range" min="{{ $min_price }}" max="{{ $max_price }}" value="{{ $min_price }}" />
                            <input class="range-max" type="range" min="{{ $min_price }}" max="{{ $max_price }}" value="{{ $max_price }}" />
                        </div>
                        <div class="price-block flex items-center justify-between flex-wrap mt-4">
                            <div class="min flex items-center gap-1">
                                <div>Min price:</div>
                                <div class="min-price">${{ $min_price }}</div>
                            </div>
                            <div class="min flex items-center gap-1">
                                <div>Max price:</div>
                                <div class="max-price">${{ $max_price }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="filter-color pb-8 border-b border-line mt-8">
                        <div class="heading6">colors</div>
                        <div class="list-color flex items-center flex-wrap gap-3 gap-y-4 mt-4">
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="pink">
                                <div class="color bg-[#F4C5BF] w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">pink</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="red">
                                <div class="color bg-red w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">red</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="green">
                                <div class="color bg-green w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">green</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="yellow">
                                <div class="color bg-yellow w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">yellow</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="purple">
                                <div class="color bg-purple w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">purple</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="black">
                                <div class="color bg-black w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">black</div>
                            </div>
                            <div class="color-item px-3 py-[5px] flex items-center justify-center gap-2 rounded-full border border-line" data-item="white">
                                <div class="color bg-[#F6EFDD] w-5 h-5 rounded-full"></div>
                                <div class="caption1 capitalize">white</div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="filter-brand pb-8 mt-8">
                        <div class="heading6">Brands</div>
                        <div class="list-brand mt-4">
                            <div class="brand-item flex items-center justify-between" data-item="adidas">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="adidas" id="adidas" />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="adidas" class="brand-name capitalize pl-2 cursor-pointer">adidas</label>
                                </div>
                                <div class="text-secondary2 number">12</div>
                            </div>
                            <div class="brand-item flex items-center justify-between" data-item="hermes">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="hermes" id="hermes" />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="hermes" class="brand-name capitalize pl-2 cursor-pointer">hermes</label>
                                </div>
                                <div class="text-secondary2 number">12</div>
                            </div>
                            <div class="brand-item flex items-center justify-between" data-item="zara">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="zara" id="zara" />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="zara" class="brand-name capitalize pl-2 cursor-pointer">zara</label>
                                </div>
                                <div class="text-secondary2 number">12</div>
                            </div>
                            <div class="brand-item flex items-center justify-between" data-item="nike">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="nike" id="nike" />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="nike" class="brand-name capitalize pl-2 cursor-pointer">nike</label>
                                </div>
                                <div class="text-secondary2 number">12</div>
                            </div>
                            <div class="brand-item flex items-center justify-between" data-item="gucci">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="gucci" id="gucci" />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="gucci" class="brand-name capitalize pl-2 cursor-pointer">gucci</label>
                                </div>
                                <div class="text-secondary2 number">12</div>
                            </div>
                        </div>
                    </div> -->
                    @foreach ($categories as $category)

                    <div class="filter-attributes pb-8 mt-8">
                        <div class="heading6">{{$category->name}}</div>
                        <div class="list-attributes mt-4">
                            @foreach($category->attributes as $attribute)

                            <div class="attributes-item flex items-center justify-between" data-item="{{ $attribute->name }}">
                                <div class="left flex items-center cursor-pointer">
                                    <div class="block-input">
                                        <input type="checkbox" name="{{ $attribute->name }}" id="{{ $attribute->name }}" value="{{ $attribute->id }}" {{ isset($filter_atribs) ? (is_array($filter_atribs) ? (in_array($attribute->id,$filter_atribs) ? 'checked' :'') :'') : '' }} />
                                        <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                                    </div>
                                    <label for="{{ $attribute->name }}" class="attributes-name capitalize pl-2 cursor-pointer">{{ $attribute->name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-success">Apply Filters</button>
                </form>
            </div>
            <div class="list-product-block style-grid lg:w-3/4 md:w-2/3 w-full md:pl-3">
                <div class="filter-heading flex items-center justify-between gap-5 flex-wrap">
                    <div class="left flex has-line items-center flex-wrap gap-5">
                        {{-- <div class="choose-layout menu-tab flex items-center gap-2">
                            <div class="item tab-item style-grid three-col p-2 border border-line rounded flex items-center justify-center cursor-pointer active">
                                <div class="flex items-center gap-0.5">
                                    <span class="w-[3px] h-4 bg-secondary2 rounded-sm"></span>
                                    <span class="w-[3px] h-4 bg-secondary2 rounded-sm"></span>
                                    <span class="w-[3px] h-4 bg-secondary2 rounded-sm"></span>
                                </div>
                            </div>
                            <div class="item tab-item style-list row w-8 h-8 border border-line rounded flex items-center justify-center cursor-pointer">
                                <div class="flex flex-col items-center gap-0.5">
                                    <span class="w-4 h-[3px] bg-secondary2 rounded-sm"></span>
                                    <span class="w-4 h-[3px] bg-secondary2 rounded-sm"></span>
                                    <span class="w-4 h-[3px] bg-secondary2 rounded-sm"></span>
                                </div>
                            </div>
                        </div>
                        <div class="check-sale flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="filterSale" id="filter-sale" class="border-line" />
                            <label for="filter-sale" class="cation1 cursor-pointer">Show only products on sale</label>
                        </div> --}}
                    </div>
                    <div class="sort-product right flex items-center gap-3">
                        <label for="select-filter" class="caption1 capitalize">Sort by</label>
                        <div class="select-block relative">
                            <select id="select-filter" name="select-filter" class="caption1 py-2 pl-3 md:pr-20 pr-10 rounded-lg border border-line">
                                <option value="Sorting">Sorting</option>
                                <option value="soldQuantityHighToLow">Best Selling</option>
                                <option value="discountHighToLow">Best Discount</option>
                                <option value="priceHighToLow">Price High To Low</option>
                                <option value="priceLowToHigh">Price Low To High</option>
                            </select>
                            <i class="ph ph-caret-down absolute top-1/2 -translate-y-1/2 md:right-4 right-2"></i>
                        </div>
                    </div>
                </div>
                <div class="list-filtered flex items-center gap-3 flex-wrap"></div>
                @if (count($products)>0)

                <div class="list-product hide-product-sold grid lg:grid-cols-3 grid-cols-2 sm:gap-[30px] gap-[20px] mt-7" data-item="9">
                    @foreach ($products as $product)
                    @php
                    $photo = explode(',', $product->photo);
                    // dd($photo[0]);
                    @endphp
                    <div data-item="{{ $product->id }}" class="product-item grid-type">
                        <div class="product-main cursor-pointer block" data-item="22">
                            <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">
                                <div class="product-tag text-button-uppercase text-white bg-red px-3 py-0.5 inline-block rounded-full absolute top-3 left-3 z-[1]">Sale</div>
                                <div class="list-action-right absolute top-3 right-3 max-lg:hidden">
                                    <div class="add-wishlist-btn w-[32px] h-[32px] flex items-center justify-center rounded-full bg-white duration-300 relative">
                                        <div class="tag-action bg-black text-white caption2 px-1.5 py-0.5 rounded-sm">
                                            Add To Wishlist</div>
                                        <i class="ph ph-heart text-lg"></i>
                                    </div>
                                </div>
                                <div class="product-img w-full h-full aspect-[3/4]">
                                    <img key="0" class="w-full h-full object-cover duration-700" src="{{ isset($photo[0]) ? $photo[0] : ''  }}" alt="img">
                                    @if (isset($photo[1]))

                                    <img key="1" class="w-full h-full object-cover duration-700" src="{{ $photo[1] }}" alt="img">
                                    @endif
                                </div>
                                <div class="list-action grid grid-cols-2 gap-3 px-5 absolute w-full bottom-5 max-lg:hidden">
                                    <div class="quick-view-btn w-full text-button-uppercase py-2 text-center rounded-full duration-300 bg-white hover:bg-black hover:text-white">
                                        <span class="max-lg:hidden">Quick View</span>
                                        <i class="ph ph-eye lg:hidden text-xl"></i>
                                    </div>

                                    <div class="add-cart-btn w-full text-button-uppercase py-2 text-center rounded-full duration-300 bg-white hover:bg-black hover:text-white">
                                        <span class="max-lg:hidden">Add To Cart</span>
                                        <i class="ph ph-shopping-bag-open lg:hidden text-xl"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="product-infor mt-4 lg:mb-7">
                                <div class="product-name text-title duration-300">{{ $product->title }}</div>

                                <div class="product-price-block flex items-center gap-2 flex-wrap mt-1 duration-300 relative z-[1]">
                                    <div class="product-price text-title">${{ $product->price - ($product->price*$product->discount)/100 }}</div>

                                    <div class="product-origin-price caption1 text-secondary2">
                                        <del>${{ $product->price }}</del>
                                    </div>
                                    <div class="product-sale caption1 font-medium bg-green px-3 py-0.5 inline-block rounded-full">
                                        -{{ $product->discount }}%
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                No Products
                @endif

                <div class="list-pagination w-full flex items-center gap-4 mt-10"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-js-before-main')

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/shop.js') }}"></script>
@endsection
@section('extra-js')


@endsection