@extends('layouts.frontend.app')

@section('extends-header')

<div class="breadcrumb-block style-shared">
    <div class="breadcrumb-main bg-linear overflow-hidden">
        <div class="container lg:pt-[134px] pt-24 pb-10 relative">
            <div class="main-content w-full h-full flex flex-col items-center justify-center relative z-[1]">
                <div class="text-content">
                    <div class="heading2 text-center">Verify Account</div>
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
        <div class="content-main flex gap-y-8 max-md:flex-col">
            <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                <div class="heading4">Register</div>

                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif
                <form method="POST" action="{{ route('verification.resend') }}" class="md:mt-7 mt-4">
                    @csrf
                    <div class="email mt-5">
                        <input name="email" class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="username" type="email" placeholder="Email address *" required value="{{ old('email') }}" />
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
