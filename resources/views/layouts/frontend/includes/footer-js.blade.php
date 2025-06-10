<script src="{{ asset('assets/js/phosphor-icons.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script>
    let appUrl = "{{ rtrim(config('app.url'),'/') }}/";
    // window.APP_URL = appUrl;
</script>
@yield('extra-js-before-main')

<script src="{{ asset('assets/js/main.js') }}"></script>

@if(session('just_logged_in'))
    <script>
        // Replace with your actual user ID variable if available
        syncCartToDatabase({{ auth()->user()->id }});
    </script>
    @php(session()->forget('just_logged_in'))
@endif
@yield('extra-js')
