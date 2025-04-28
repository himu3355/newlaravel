<div id="footer" class="footer">
    <div class="footer-main bg-surface">
        <div class="container">
            @php
                $settings=DB::table('settings')->get();
            @endphp
            <div class="content-footer md:py-[60px] py-10 flex justify-between flex-wrap gap-y-8">
                <div class="company-infor basis-1/4 max-lg:basis-full pr-7">
                    <a href="index.html" class="logo inline-block">
                        <div class="heading3 w-fit">E-Commerce</div>
                    </a>
                    <div class="flex gap-3 mt-3">
                        <div class="flex flex-col">
                            <span class="text-button">Mail:</span>
                            <span class="text-button mt-3">Phone:</span>
                            <span class="text-button mt-3">Address:</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="">@foreach($settings as $data) {{$data->email}} @endforeach</span>
                            <span class="mt-[14px]">@foreach($settings as $data) {{$data->address}} @endforeach</span>
                            <span class="mt-3 pt-1">@foreach($settings as $data) {{$data->phone}} @endforeach</span>
                        </div>
                    </div>
                </div>
                <div class="right-content flex flex-wrap gap-y-8 basis-3/4 max-lg:basis-full">
                    <div class="list-nav flex justify-between basis-2/3 max-md:basis-full gap-4">
                        <div class="item flex flex-col basis-1/2">
                            <div class="text-button-uppercase pb-3">Infomation</div>
                            <a class="caption1 has-line-before duration-300 w-fit" href="contact.html">Contact us </a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="#!"> Career </a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="my-account.html"> My Account</a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="order-tracking.html"> Order & Returns</a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="faqs.html">FAQs </a>
                        </div>
                        <div class="item flex flex-col basis-1/2">
                            <div class="text-button-uppercase pb-3">Customer Services</div>
                            <a class="caption1 has-line-before duration-300 w-fit" href="faqs.html">FAQs </a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="faqs.html">Shipping </a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="faqs.html">Privacy Policy</a>
                            <a class="caption1 has-line-before duration-300 w-fit pt-2" href="order-tracking.html">Return & Refund</a>
                        </div>
                    </div>
                    <div class="newsletter basis-1/3 pl-7 max-md:basis-full max-md:pl-0">
                        <div class="text-button-uppercase">Newletter</div>
                        <div class="caption1 mt-3">Sign up for our newsletter and get 10% off your first purchase</div>
                        <div class="input-block w-full h-[52px] mt-4">
                            <form class="w-full h-full relative" action="post">
                                <input type="email" placeholder="Enter your e-mail" class="caption1 w-full h-full pl-4 pr-14 rounded-xl border border-line" required />
                                <button class="w-[44px] h-[44px] bg-black flex items-center justify-center rounded-xl absolute top-1 right-1">
                                    <i class="ph ph-arrow-right text-xl text-white"></i>
                                </button>
                            </form>
                        </div>
                        <div class="list-social flex items-center gap-6 mt-4">
                            <a href="https://www.facebook.com/" target="_blank">
                                <div class="icon-facebook text-2xl text-black"></div>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank">
                                <div class="icon-instagram text-2xl text-black"></div>
                            </a>
                            <a href="https://www.twitter.com/" target="_blank">
                                <div class="icon-twitter text-2xl text-black"></div>
                            </a>
                            <a href="https://www.youtube.com/" target="_blank">
                                <div class="icon-youtube text-2xl text-black"></div>
                            </a>
                            <a href="https://www.pinterest.com/" target="_blank">
                                <div class="icon-pinterest text-2xl text-black"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom py-3 flex items-center justify-between gap-5 max-lg:justify-center max-lg:flex-col border-t border-line">
                <div class="left flex items-center gap-8">
                    <div class="copyright caption1 text-secondary">Copyright © {{date('Y')}} All Rights Reserved.</div>
                    <div class="select-block flex items-center gap-5 max-md:hidden">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
