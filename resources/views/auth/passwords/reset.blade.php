@extends('layouts.frontend.app')

@section('extends-header')

<div class="breadcrumb-block style-shared">
    <div class="breadcrumb-main bg-linear overflow-hidden">
        <div class="container lg:pt-[134px] pt-24 pb-10 relative">
            <div class="main-content w-full h-full flex flex-col items-center justify-center relative z-[1]">
                <div class="text-content">
                    <div class="heading2 text-center">Forgot Password</div>
                    <div class="link flex items-center justify-center gap-1 caption1 mt-3">
                        <a href="index.html">Homepage</a>
                        <i class="ph ph-caret-right text-sm text-secondary2"></i>
                        <div class="text-secondary2 capitalize">Forgot Password</div>
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
                <div class="heading4">Forgot Password</div>
                <form method="POST" action="{{ route('password.update') }}" class="md:mt-7 mt-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="email mt-5">
                        <input name="email" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="username" type="email" placeholder="Email address *" required value="{{ $email ?? old('email') }}" />
                    </div>
                    <div class="pass mt-5">
                        <input name="password" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="password" type="password" placeholder="Password *" required />
                    </div>
                    <div class="confirm-pass mt-5">
                        <input name="password_confirmation" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="confirmPassword" type="password" placeholder="Confirm Password *" required />
                    </div>
                    <div class="block-button md:mt-7 mt-4">
                        <button class="button-main">Reset Password</button>
                    </div>
                </form>
            </div>
            <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                <div class="text-content">
                    <div class="heading4">Already have an account?</div>
                    <div class="mt-2 text-secondary">Welcome back. Sign in to access your personalized experience, saved preferences, and more. We{String.raw`'re`} thrilled to have you with us again!</div>
                    <div class="block-button md:mt-7 mt-4">
                        <a href="{{ route('login') }}" class="button-main">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
