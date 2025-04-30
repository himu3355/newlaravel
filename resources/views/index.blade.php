@extends('layouts.frontend.app')


@section('extends-header')

            <!-- Slider -->
@if(count($banners)>0)
            <div class="slider-block toys-kid 2xl:h-[760px] xl:h-[680px] lg:h-[580px] md:h-[460px] sm:h-[400px] h-[400px] w-full mt-[30px]">
                <div class="container h-full">
                    <div class="slider-main h-full w-full">
                        <div class="slider-toys-kid h-full">


                            @foreach($banners as $key=>$banner)
                            <div class="slider-item">
                                <div class="bg-[#EBFCF5] h-full w-full relative flex max-sm:flex-col-reverse items-center lg:rounded-[40px] rounded-xl overflow-hidden">
                                    <img src="./assets/images/slider/bg-toys.png" alt="bg" class="absolute top-0 left-0 w-full h-full object-cover" />
                                    <div class="text-content sm:w-1/3 max-sm:pt-10 max-sm:pb-[40px] flex flex-col items-center justify-center z-[1]">
                                        <div class="text-sub-display">{{ $banner['description'] }}</div>
                                        <div class="heading1 text-center md:mt-4 mt-2">{{ $banner->title }}</div>
                                        <a href="shop-breadcrumb-img.html" class="button-main md:mt-8 mt-3">Shop Now</a>
                                    </div>
                                    <div class="sub-img sm:w-2/3 w-full h-full sm:pl-10">
                                        <img src="{{ $banner->photo }}" alt="bg-toys1" class="w-full h-full object-cover z-[1] relative" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="slider-item">
                                <div class="bg-[#F4F4F4] h-full w-full relative flex max-sm:flex-col-reverse items-center lg:rounded-[40px] rounded-xl overflow-hidden">
                                    <img src="./assets/images/slider/bg-toys.png" alt="bg" class="absolute top-0 left-0 w-full h-full object-cover" />
                                    <div class="text-content sm:w-1/3 max-sm:pt-10 max-sm:pb-[40px] flex flex-col items-center justify-center z-[1]">
                                        <div class="text-sub-display">Sale! Up To 50% Off!</div>
                                        <div class="heading1 text-center md:mt-4 mt-2">blankets for newborns</div>
                                        <a href="shop-breadcrumb-img.html" class="button-main md:mt-8 mt-3">Shop Now</a>
                                    </div>
                                    <div class="sub-img sm:w-2/3 w-full h-full sm:pl-10">
                                        <img src="./assets/images/slider/bg-toys2.png" alt="bg-toys2" class="w-full h-full object-cover z-[1] relative" />
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item">
                                <div class="bg-[#ECF8F1] h-full w-full relative flex max-sm:flex-col-reverse items-center lg:rounded-[40px] rounded-xl overflow-hidden">
                                    <img src="./assets/images/slider/bg-toys.png" alt="bg" class="absolute top-0 left-0 w-full h-full object-cover" />
                                    <div class="text-content sm:w-1/3 max-sm:pt-10 max-sm:pb-[40px] flex flex-col items-center justify-center z-[1]">
                                        <div class="text-sub-display">Sale! Up To 50% Off!</div>
                                        <div class="heading1 text-center md:mt-4 mt-2">Kids Toys & Clothing</div>
                                        <a href="shop-breadcrumb-img.html" class="button-main md:mt-8 mt-3">Shop Now</a>
                                    </div>
                                    <div class="sub-img sm:w-2/3 w-full h-full sm:pl-10">
                                        <img src="./assets/images/slider/bg-toys3.png" alt="bg-toys3" class="w-full h-full object-cover z-[1] relative" />
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endif

@endsection

@section('content')

<div class="container">
            <div class="benefit-block md:py-20 py-10">
                <div class="heading text-center">
                    <div class="heading3">What Makes Us Different</div>
                    <div class="hading6 normal-case text-secondary text-center mt-3">Sign up for early sale access, new in, promotions and more</div>
                </div>
                <div class="list-benefit grid items-start lg:grid-cols-4 grid-cols-2 gap-[30px] md:mt-10 mt-6">
                    <div class="benefit-item flex flex-col items-center justify-center">
                        <i class="icon-phone-call lg:text-7xl text-5xl"></i>
                        <div class="heading6 text-center mt-5">24/7 Customer Service</div>
                        <div class="caption1 text-secondary text-center mt-3">We&apos;re here to help you with any questions or concerns you have, 24/7.</div>
                    </div>
                    <div class="benefit-item flex flex-col items-center justify-center">
                        <i class="icon-return lg:text-7xl text-5xl"></i>
                        <div class="heading6 text-center mt-5">14-Day Money Back</div>
                        <div class="caption1 text-secondary text-center mt-3">If you&apos;re not satisfied with your purchase, simply return it within 14 days for a refund.</div>
                    </div>
                    <div class="benefit-item flex flex-col items-center justify-center">
                        <i class="icon-guarantee lg:text-7xl text-5xl"></i>
                        <div class="heading6 text-center mt-5">Our Guarantee</div>
                        <div class="caption1 text-secondary text-center mt-3">We stand behind our products and services and guarantee your satisfaction.</div>
                    </div>
                    <div class="benefit-item flex flex-col items-center justify-center">
                        <i class="icon-delivery-truck lg:text-7xl text-5xl"></i>
                        <div class="heading6 text-center mt-5">Shipping worldwide</div>
                        <div class="caption1 text-secondary text-center mt-3">We ship our products worldwide, making them accessible to customers everywhere.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-block style-toys-kids">
            <div class="container">
                <div class="content md:rounded-[28px] rounded-2xl overflow-hidden relative">
                    <img src="./assets/images/banner/bg-banner-toys.png" alt="bg" class="absolute top-0 left-0 w-full h-full object-cover z-[-1]" />
                    <div class="text-content xl:w-1/3 w-2/3 xl:pl-[120px] md:pl-20 pl-10 md:py-[85px] py-12">
                        <div class="text-sub-display">Sale Up To 50% Off Today!</div>
                        <div class="heading2 md:mt-4 mt-2">Created to be loved for a lifetime</div>
                        <a href="shop-breadcrumb-img.html" class="button-main md:mt-7 mt-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-features-block filter-product-block md:pt-20 pt-10">
            <div class="container">
                <div class="heading flex flex-col items-center text-center">
                    <div class="menu-tab bg-surface rounded-2xl">
                        <div class="menu flex items-center gap-2 p-1">
                            <div class="indicator absolute top-1 bottom-1 bg-white rounded-full shadow-md duration-300"></div>
                            <div class="tab-item relative text-secondary heading5 py-2 px-5 cursor-pointer duration-500 hover:text-black active" data-item="best sellers">best sellers</div>
                            <div class="tab-item relative text-secondary heading5 py-2 px-5 cursor-pointer duration-500 hover:text-black" data-item="on sale">on sale</div>
                            <div class="tab-item relative text-secondary heading5 py-2 px-5 cursor-pointer duration-500 hover:text-black" data-item="new arrivals">new arrivals</div>
                        </div>
                    </div>
                </div>
                <div class="list-product six-product hide-product-sold relative section-swiper-navigation style-outline style-small-border md:mt-10 mt-6">
                    <div class="swiper-button-prev2 sm:left-10 left-6">
                        <i class="ph-bold ph-caret-left text-xl"></i>
                    </div>
                    <div class="swiper swiper-list-product h-full relative">
                        <div class="swiper-wrapper">
                            <!-- List six product -->
                        </div>
                    </div>
                    <div class="swiper-button-next2 sm:right-10 right-6">
                        <i class="ph-bold ph-caret-right text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-block md:mt-20 mt-10">
            <div class="container">
                <div class="content bg-surface xl:-mx-5 rounded-3xl md:py-[60px] py-8">
                    <div class="heading3 text-center">Happy Clients</div>
                    <div class="list-testi relative w-full section-swiper-navigation style-outline style-center style-border mt-5">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper swiper-testimonial-four h-full relative">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testi-item flex flex-col items-center justify-center xl:px-[120px] md:px-[60px] px-8">
                                        <div class="desc heading4 font-medium text-center">I absolutely love this shop! The products are high-quality and the customer service is excellent. I always leave with exactly what I need and a smile on my face.</div>
                                        <div class="infor flex flex-col items-center justify-center mt-10">
                                            <div class="avatar w-20 h-20 rounded-full overflow-hidden">
                                                <img src="./assets/images/avatar/1.png" alt="avatar" class="w-full h-full" />
                                            </div>
                                            <div class="name body1 font-semibold uppercase mt-5">Georgina S.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-item flex flex-col items-center justify-center xl:px-[120px] md:px-[60px] px-8">
                                        <div class="desc heading4 font-medium text-center">I absolutely love this shop! The products are high-quality and the customer service is excellent. I always leave with exactly what I need and a smile on my face.</div>
                                        <div class="infor flex flex-col items-center justify-center mt-10">
                                            <div class="avatar w-20 h-20 rounded-full overflow-hidden">
                                                <img src="./assets/images/avatar/5.png" alt="avatar" class="w-full h-full" />
                                            </div>
                                            <div class="name body1 font-semibold uppercase mt-5">Georgina S.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-item flex flex-col items-center justify-center xl:px-[120px] md:px-[60px] px-8">
                                        <div class="desc heading4 font-medium text-center">I absolutely love this shop! The products are high-quality and the customer service is excellent. I always leave with exactly what I need and a smile on my face.</div>
                                        <div class="infor flex flex-col items-center justify-center mt-10">
                                            <div class="avatar w-20 h-20 rounded-full overflow-hidden">
                                                <img src="./assets/images/avatar/4.png" alt="avatar" class="w-full h-full" />
                                            </div>
                                            <div class="name body1 font-semibold uppercase mt-5">Georgina S.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="news-block md:py-20 py-10">
            <div class="container">
                <div class="heading3 text-center">News insight</div>
                <div class="list-blog grid lg:grid-cols-3 sm:grid-cols-2 md:gap-[30px] gap-4 md:mt-10 mt-6">
                    <a href="blog-detail1.html" class="blog-item style-one h-full cursor-pointer">
                        <div class="blog-main h-full block">
                            <div class="blog-thumb rounded-[20px] overflow-hidden">
                                <img src="./assets/images/blog/toys1.png" alt="blog-img" class="w-full duration-500" />
                            </div>
                            <div class="blog-infor mt-7">
                                <div class="blog-tag bg-green py-1 px-2.5 rounded-full text-button-uppercase inline-block">body lotion</div>
                                <div class="heading6 blog-title mt-3 duration-300">Bed Trends to Watch Out for in Summer 2024</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="blog-author caption1 text-secondary">by Chris Evans</div>
                                    <span class="w-[20px] h-[1px] bg-black"></span>
                                    <div class="blog-date caption1 text-secondary">Dec 20, 2024</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="blog-detail1.html" class="blog-item style-one h-full cursor-pointer">
                        <div class="blog-main h-full block">
                            <div class="blog-thumb rounded-[20px] overflow-hidden">
                                <img src="./assets/images/blog/toys2.png" alt="blog-img" class="w-full duration-500" />
                            </div>
                            <div class="blog-infor mt-7">
                                <div class="blog-tag bg-green py-1 px-2.5 rounded-full text-button-uppercase inline-block">toys</div>
                                <div class="heading6 blog-title mt-3 duration-300">How to Build a Sustainable and Stylish Wardrobe 2024</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="blog-author caption1 text-secondary">by Alex Balde</div>
                                    <span class="w-[20px] h-[1px] bg-black"></span>
                                    <div class="blog-date caption1 text-secondary">Dec 12, 2024</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="blog-detail1.html" class="blog-item style-one h-full cursor-pointer max-lg:hidden max-sm:block">
                        <div class="blog-main h-full block">
                            <div class="blog-thumb rounded-[20px] overflow-hidden">
                                <img src="./assets/images/blog/toys3.png" alt="blog-img" class="w-full duration-500" />
                            </div>
                            <div class="blog-infor mt-7">
                                <div class="blog-tag bg-green py-1 px-2.5 rounded-full text-button-uppercase inline-block">blankets</div>
                                <div class="heading6 blog-title mt-3 duration-300">Blankets and Pads for Kids Trending in 2024</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="blog-author caption1 text-secondary">by Leona Pablo</div>
                                    <span class="w-[20px] h-[1px] bg-black"></span>
                                    <div class="blog-date caption1 text-secondary">Dec 10, 2024</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

@endsection

@section('extra-js-before-main')

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
@endsection
