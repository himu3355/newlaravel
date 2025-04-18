<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.frontend.includes.head')
    </head>

    <body>
        @include('layouts.frontend.includes.navbar')
        @yield('content')

        @include('layouts.frontend.includes.footer')
        <a class="scroll-to-top-btn" href="#top-nav"><i class="ph-bold ph-caret-up"></i></a>

        @include('layouts.frontend.includes.modals')

        @include('layouts.frontend.includes.footer-js')
    </body>
</html>
