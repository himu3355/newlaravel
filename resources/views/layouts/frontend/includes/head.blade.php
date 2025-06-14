<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Bunnys Bag</title>
<link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('dist/output-scss.css') }}" />
<link rel="stylesheet" href="{{ asset('dist/output-tailwind.css') }}" />
<script>
    let appUrl = "{{ rtrim(config('app.url'),'/') }}/";
    window.APP_URL = appUrl;
</script>
@if(Auth::check())
<script>
    window.LOGGED_IN_USER_ID = {{ Auth::id() }};
</script>
@endif
@yield('extra-css')
