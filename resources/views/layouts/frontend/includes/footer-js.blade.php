<script src="{{ asset('assets/js/phosphor-icons.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script>
    let appUrl = "{{ rtrim(config('app.url'),'/') }}/";
    // window.APP_URL = appUrl;
</script>
@yield('extra-js-before-main')

<script src="{{ asset('assets/js/main.js') }}"></script>

@yield('extra-js')
