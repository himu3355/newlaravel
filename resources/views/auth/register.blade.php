@extends('layouts.frontend.app')

@section('extends-header')
    <div class="breadcrumb-block style-shared">
        <div class="breadcrumb-main bg-linear overflow-hidden">
            <div class="container lg:pt-[134px] pt-24 pb-10 relative">
                <div class="main-content w-full h-full flex flex-col items-center justify-center relative z-[1]">
                    <div class="text-content">
                        <div class="heading2 text-center">Register</div>
                        <div class="link flex items-center justify-center gap-1 caption1 mt-3">
                            <a href="index.html">Homepage</a>
                            <i class="ph ph-caret-right text-sm text-secondary2"></i>
                            <div class="text-secondary2 capitalize">Register</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="register-block md:py-20 py-10">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="content-main flex gap-y-8 max-md:flex-col">
                <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                    <div class="heading4">Register</div>
                    <form method="POST" action="{{ route('register') }}" class="md:mt-7 mt-4">
                        @csrf
                        <div class="name">
                            <input name="name" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="username"
                                type="text" placeholder="Your Name *" required="" value="{{ old('name') }}">
                        </div>

                        @error('name')
                            <strong>{{ $message }}</strong>
                        @enderror
                        <div class="email mt-5">
                            <input name="email" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="username"
                                type="email" placeholder="Email address *" required value="{{ old('email') }}" />
                        </div>
                        <div class="pass mt-5">
                            <input name="password" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="password"
                                type="password" placeholder="Password *" required />
                        </div>
                        <div class="confirm-pass mt-5">
                            <input name="password_confirmation" class="border-line px-4 pt-3 pb-3 w-full rounded-lg"
                                id="confirmPassword" type="password" placeholder="Confirm Password *" required />
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="block-input">
                                <input type="checkbox" name="remember" id="remember" />
                                <i class="ph-fill ph-check-square icon-checkbox text-2xl"></i>
                            </div>
                            <label for="remember" class="pl-2 cursor-pointer text-secondary2">I agree to the
                                <a href="#!" class="text-black hover:underline pl-1">Terms of User</a>
                            </label>
                        </div>
                        <div class="block-button md:mt-7 mt-4">
                            <button class="button-main">Register</button>
                        </div>
                    </form>
                </div>
                <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                    <div class="text-content">
                        <div class="heading4">Already have an account?</div>
                        <div class="mt-2 text-secondary">Welcome back. Sign in to access your personalized experience, saved
                            preferences, and more. We{String.raw`'re`} thrilled to have you with us again!</div>
                        <div class="block-button md:mt-7 mt-4">
                            <a href="{{ route('login') }}" class="button-main">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
