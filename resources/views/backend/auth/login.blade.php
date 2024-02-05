@extends('backend.base')

@push('script')
@endpush


@section('content')
    <div class="position-relative overflow-hidden radial-gradient min-vh-100">
        <div class="position-relative z-index-5">
            <div class="row">
                <div class="col-xl-7 col-xxl-8">
                    <a href="{{ route('frontend') }}" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                        <img src="{{ asset('back/dist/images/logos/logo-mely-horizontal.webp') }}" width="180" height="50"
                            alt="logo-mely">
                    </a>
                    <div class="d-none d-xl-flex align-items-center justify-content-center"
                        style="height: calc(100vh - 80px);">
                        <img src="{{ asset('back/dist/images/backgrounds/login-sendal.webp') }}" alt="image-responsive"
                            class="img-fluid" width="650" height="650">
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-4">
                    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                        <div class="col-sm-8 col-md-6 col-xl-9">
                            <h2 class="mb-3 fs-7 fw-bolder">Welcome to Sandal Mely</h2>
                            <p class=" mb-9">Your Admin Dashboard</p>
                            <div class="row">
                                <div class="col-12 mb-2 mb-sm-0">
                                    <a class="btn btn-white text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                                        href="{{ url('auth/google') }}" role="button">
                                        <img src="{{ asset('back/dist/images/svgs/google-icon.svg') }}" alt=""
                                            class="img-fluid me-2" width="18" height="18" sizes="18">
                                        <span class="d-none d-sm-block me-1 flex-shrink-0">Sign in with</span>Google
                                    </a>
                                </div>
                            </div>
                            <div class="position-relative text-center my-4">
                                <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">or
                                    sign in with</p>
                                <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                            </div>
                            <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name='email' :value="old('email')" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('email') is-invalid @enderror" id="exampleInputPassword1"
                                        required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" value=""
                                            id="flexCheckChecked" checked>
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                            Remember this Device
                                        </label>
                                    </div>
                                    <a class="text-primary fw-medium" href="{{ route('forgotpassword') }}">Forgot
                                        Password ?</a>
                                </div>
                                <button class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit">Sign In</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-medium">New Customer in Here ?</p>
                                    <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Create an
                                        account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
