@extends('layouts.backend.base')

@push('script')
@endpush


@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed"
        data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body pt-5">
                                <a href="{{ route('frontend') }}" class="text-center d-block mb-4">
                                    <img src="{{ asset('back/dist/images/logos/logo-mely-horizontal.webp') }}" width="180"
                                        alt="">
                                </a>
                                <div class="mb-5 text-center">
                                    <p class="mb-0 ">
                                        This password reset link will expire in 60 minutes,
                                        If you did not request a password reset, no further action is required.

                                    </p>
                                    <p class="mt-2 ">
                                        Regards,
                                        Sandal Mely
                                    </p>
                                </div>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" :value="old('email', $request - > email)"
                                            required autofocus class="form-control" id="email" aria-describedby="email">

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password Reset</label>
                                        <input type="password" name="password" required autofocus class="form-control"
                                            id="password" aria-describedby="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" required autofocus class="form-control"
                                            id="password_confirmation" aria-describedby="password_confirmation">
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit">Reset Password</button>
                                    <a href="{{ route('frontend') }}"
                                        class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form> --}}
