@extends('layouts.frontend.app')

@section('extends-header')

<div class="breadcrumb-block style-shared">
    <div class="breadcrumb-main bg-linear overflow-hidden">
        <div class="container lg:pt-[134px] pt-24 pb-10 relative">
            <div class="main-content w-full h-full flex flex-col items-center justify-center relative z-[1]">
                <div class="text-content">
                    <div class="heading2 text-center">About Us</div>
                    <div class="link flex items-center justify-center gap-1 caption1 mt-3">
                        <a href="{{ route('home') }}">Homepage</a>
                        <i class="ph ph-caret-right text-sm text-secondary2"></i>
                        <div class="text-secondary2 capitalize">About Us</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="about md:pt-20 pt-10">
    <div class="about-us-block">
        <div class="container">
            <div class="text flex items-center justify-center">
                <div class="content md:w-5/6 w-full">
                    <div class="heading3 text-center">I'm obsessed with the dress Pippa Middleton wore to her brother's wedding.</div>
                    <div class="body1 text-center md:mt-7 mt-5">Kim Kardashian West needs no introduction. In the 14 years since she first graced our screens in Keeping Up With The Kardashians, she has built her KKW beauty empire, filmed her show, wrapped her show, become a billionaire, studied law, campaigned for the rights of death row inmates, travelled the world to attend events such as Paris Fashion Week, raised four children and launched her wildly successful shapewear brand SKIMS.</div>
                </div>
            </div>
            <div class="list-img grid sm:grid-cols-3 gap-[30px] md:pt-20 pt-10">
                <div class="bg-img">
                    <img src="./assets/images/other/about-us1.png" alt="bg-img" class="w-full rounded-[30px]" />
                </div>
                <div class="bg-img">
                    <img src="./assets/images/other/about-us2.png" alt="bg-img" class="w-full rounded-[30px]" />
                </div>
                <div class="bg-img">
                    <img src="./assets/images/other/about-us3.png" alt="bg-img" class="w-full rounded-[30px]" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="benefit-block md:pt-20 pt-10">
    <div class="container">
        <div class="list-benefit grid items-start lg:grid-cols-4 grid-cols-2 gap-[30px]">
            <div class="benefit-item flex flex-col items-center justify-center">
                <i class="icon-phone-call lg:text-7xl text-5xl"></i>
                <div class="heading6 text-center mt-5">24/7 Customer Service</div>
                <div class="caption1 text-secondary text-center mt-3">We're here to help you with any questions or concerns you have, 24/7.</div>
            </div>
            <div class="benefit-item flex flex-col items-center justify-center">
                <i class="icon-return lg:text-7xl text-5xl"></i>
                <div class="heading6 text-center mt-5">14-Day Money Back</div>
                <div class="caption1 text-secondary text-center mt-3">If you're not satisfied with your purchase, simply return it within 14 days for a refund.</div>
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

<div class="container">
    <div class="newsletter-block md:py-20 sm:py-14 py-10 sm:px-8 px-6 sm:rounded-[32px] rounded-3xl flex flex-col items-center bg-green md:mt-20 mt-10 md:mb-20 mb-10">
        <div class="heading3 text-white text-center">Sign up and get 10% off</div>
        <div class="text-white text-center mt-3">Sign up for early sale access, new in, promotions and more</div>
        <div class="input-block lg:w-1/2 sm:w-3/5 w-full h-[52px] sm:mt-10 mt-7">
            <form class="w-full h-full relative">
                <input type="email" placeholder="Enter your e-mail" class="caption1 w-full h-full pl-4 pr-14 rounded-xl border border-line" required />
                <button class="button-main bg-green text-black absolute top-1 bottom-1 right-1 flex items-center justify-center">Subscribe</button>
            </form>
        </div>
    </div>
</div>


@endsection
