<div id="top-nav" class="top-nav style-one bg-black md:h-[44px] h-[30px]">
    <div class="container mx-auto h-full">
        <div class="top-nav-main flex justify-between max-md:justify-center h-full">
            <div class="left-content flex items-center gap-5 max-md:hidden">
            </div>
            <div class="text-center text-button-uppercase text-white flex items-center">New customers save 10% with the code GET10</div>
            <div class="right-content flex items-center gap-5 max-md:hidden">
                <a href="https://www.facebook.com/" target="_blank">
                    <i class="icon-facebook text-white"></i>
                </a>
                <a href="https://www.instagram.com/" target="_blank">
                    <i class="icon-instagram text-white"></i>
                </a>
                <a href="https://www.youtube.com/" target="_blank">
                    <i class="icon-youtube text-white"></i>
                </a>
                <a href="https://twitter.com/" target="_blank">
                    <i class="icon-twitter text-white"></i>
                </a>
                <a href="https://pinterest.com/" target="_blank">
                    <i class="icon-pinterest text-white"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="header" class="relative w-full">
    <div class="header-menu style-one relative top-0 left-0 right-0 w-full md:h-[74px] h-[56px] bg-transparent">
        <div class="container mx-auto h-full">
            <div class="header-main flex justify-between h-full">
                <div class="menu-mobile-icon lg:hidden flex items-center">
                    <i class="icon-category text-2xl"></i>
                </div>
                <div class="left flex items-center gap-16">
                    <a href="index.html" class="flex items-center max-lg:absolute max-lg:left-1/2 max-lg:-translate-x-1/2">
                        <div class="heading4">E-Commerce</div>
                    </a>
                    @php
                    $attribCats = App\Models\AttributeCategory::with('attributes')->get();
                    @endphp
                    <div class="menu-main h-full max-lg:hidden">
                        <ul class="flex items-center gap-8 h-full">
                            @foreach ($attribCats as $attribCat)

                            <li class="h-full relative">
                                <a href="#!" class="text-button-uppercase duration-300 h-full flex items-center justify-center active"> {{ $attribCat->name }} </a>
                                <div class="sub-menu py-3 px-5 -left-10 absolute bg-white rounded-b-xl">
                                    <ul class="w-full">
                                        @foreach ($attribCat->attributes as $attribute)

                                        <li>
                                            <a href="{{ route('products.filter').'?attributes%5B%5D='.$attribute->id }}" class="link text-secondary duration-300"> {{ $attribute->name }} </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endforeach
                            <li class="h-full relative">
                                <a href="#!" class="text-button-uppercase duration-300 h-full flex items-center justify-center active"> Pages </a>
                                <div class="sub-menu py-3 px-5 -left-10 absolute bg-white rounded-b-xl">
                                    <ul class="w-full">
                                        <li>
                                            <a href="about.html" class="link text-secondary duration-300"> About Us </a>
                                        </li>
                                        <li>
                                            <a href="contact.html" class="link text-secondary duration-300"> Contact Us </a>
                                        </li>
                                        <li>
                                            <a href="store-list.html" class="link text-secondary duration-300"> Store List </a>
                                        </li>
                                        <li>
                                            <a href="page-not-found.html" class="link text-secondary duration-300"> 404 </a>
                                        </li>
                                        <li>
                                            <a href="faqs.html" class="link text-secondary duration-300 active"> FAQs </a>
                                        </li>
                                        <li>
                                            <a href="coming-soon.html" class="link text-secondary duration-300"> Coming Soon </a>
                                        </li>
                                        <li>
                                            <a href="customer-feedbacks.html" class="link text-secondary duration-300"> Customer Feedbacks </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right flex gap-12">
                    <div class="max-md:hidden search-icon flex items-center cursor-pointer relative">
                        <i class="ph-bold ph-magnifying-glass text-2xl"></i>
                        <div class="line absolute bg-line w-px h-6 -right-6"></div>
                    </div>
                    <div class="list-action flex items-center gap-4">
                        <div class="user-icon flex items-center justify-center cursor-pointer">
                            <i class="ph-bold ph-user text-2xl"></i>
                            <div class="login-popup absolute top-[74px] w-[320px] p-7 rounded-xl bg-white box-shadow-small">
                                <a href="login.html" class="button-main w-full text-center">Login</a>
                                <div class="text-secondary text-center mt-3 pb-4">
                                    Don’t have an account?
                                    <a href="register.html" class="text-black pl-1 hover:underline">Register </a>
                                </div>
                                <div class="bottom pt-4 border-t border-line"></div>
                                <a href="#!" class="body1 hover:underline">Support</a>
                            </div>
                        </div>
                        <div class="max-md:hidden wishlist-icon flex items-center relative cursor-pointer">
                            <i class="ph-bold ph-heart text-2xl"></i>
                            <span class="quantity wishlist-quantity absolute -right-1.5 -top-1.5 text-xs text-white bg-black w-4 h-4 flex items-center justify-center rounded-full">0</span>
                        </div>
                        <div class="max-md:hidden cart-icon flex items-center relative cursor-pointer">
                            <i class="ph-bold ph-handbag text-2xl"></i>
                            <span class="quantity cart-quantity absolute -right-1.5 -top-1.5 text-xs text-white bg-black w-4 h-4 flex items-center justify-center rounded-full">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="menu-mobile" class="">
        <div class="menu-container bg-white h-full">
            <div class="container h-full">
                <div class="menu-main h-full overflow-hidden">
                    <div class="heading py-2 relative flex items-center justify-center">
                        <div class="close-menu-mobile-btn absolute left-0 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-surface flex items-center justify-center">
                            <i class="ph ph-x text-sm"></i>
                        </div>
                        <a href="index.html" class="logo text-3xl font-semibold text-center">E-Commerce</a>
                    </div>
                    <div class="form-search relative mt-2">
                        <i class="ph ph-magnifying-glass text-xl absolute left-3 top-1/2 -translate-y-1/2 cursor-pointer"></i>
                        <input type="text" placeholder="What are you looking for?" class="h-12 rounded-lg border border-line text-sm w-full pl-10 pr-4" />
                    </div>
                    <div class="list-nav mt-6">
                        <ul>
                            <li>
                                <a href="#!" class="text-xl font-semibold flex items-center justify-between mt-5">Pages
                                    <span class="text-right">
                                        <i class="ph ph-caret-right text-xl"></i>
                                    </span>
                                </a>
                                <div class="sub-nav-mobile">
                                    <div class="back-btn flex items-center gap-3">
                                        <i class="ph ph-caret-left text-xl"></i>
                                        Back
                                    </div>
                                    <div class="list-nav-item w-full pt-2 pb-6">
                                        <ul class="w-full">
                                            <li>
                                                <a href="about.html" class="link text-secondary duration-300"> About Us </a>
                                            </li>
                                            <li>
                                                <a href="contact.html" class="link text-secondary duration-300"> Contact Us </a>
                                            </li>
                                            <li>
                                                <a href="store-list.html" class="link text-secondary duration-300"> Store List </a>
                                            </li>
                                            <li>
                                                <a href="page-not-found.html" class="link text-secondary duration-300"> 404 </a>
                                            </li>
                                            <li>
                                                <a href="faqs.html" class="link text-secondary duration-300 active"> FAQs </a>
                                            </li>
                                            <li>
                                                <a href="coming-soon.html" class="link text-secondary duration-300"> Coming Soon </a>
                                            </li>
                                            <li>
                                                <a href="customer-feedbacks.html" class="link text-secondary duration-300"> Customer Feedbacks </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu bar -->
    <div class="menu_bar fixed bg-white bottom-0 left-0 w-full h-[70px] sm:hidden z-[101]">
        <div class="menu_bar-inner grid grid-cols-4 items-center h-full">
            <a href="index.html" class="menu_bar-link flex flex-col items-center gap-1">
                <span class="ph-bold ph-house text-2xl block"></span>
                <span class="menu_bar-title caption2 font-semibold">Home</span>
            </a>
            <a href="shop-filter-canvas.html" class="menu_bar-link flex flex-col items-center gap-1">
                <span class="ph-bold ph-list text-2xl block"></span>
                <span class="menu_bar-title caption2 font-semibold">Category</span>
            </a>
            <a href="search-result.html" class="menu_bar-link flex flex-col items-center gap-1">
                <span class="ph-bold ph-magnifying-glass text-2xl block"></span>
                <span class="menu_bar-title caption2 font-semibold">Search</span>
            </a>
            <a href="cart.html" class="menu_bar-link flex flex-col items-center gap-1">
                <div class="cart-icon relative">
                    <span class="ph-bold ph-handbag text-2xl block"></span>
                    <span class="quantity cart-quantity absolute -right-1.5 -top-1.5 text-xs text-white bg-black w-4 h-4 flex items-center justify-center rounded-full">0</span>
                </div>
                <span class="menu_bar-title caption2 font-semibold">Cart</span>
            </a>
        </div>
    </div>
    @yield('extends-header')

</div>
