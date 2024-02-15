@extends('backend.base')

@section('contentlogin')
    <div class="auth-main">
        <div class="auth-wrapper v2">
            <div class="auth-sidecontent">
                <img src="{{ asset('/images/authentication/img-auth-sideimg.jpg') }}" alt="images"
                    class="img-fluid img-auth-side">
            </div>
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="{{ route('frontend') }}"><img src="{{ asset('/images/logo.png') }}" width="150" alt="img"></a>
                            <h5 class="text-center f-w-500 mb-3">Internet Provider Kesayangan Kamu</h5>
                            <div class="d-grid my-3">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="{{ asset('/images/authentication/google.svg') }}" alt="img"> <span> Sign
                                        In with Google</span>
                                </button>
                            </div>
                        </div>
                        <div class="saprator my-3">
                            <span>OR</span>
                        </div>

                        <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="Email Address" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="check"
                                        checked="" required>
                                    <label class="form-check-label text-muted" for="check">Remember me?</label>
                                </div>
                                <a class="text-secondary f-w-400 mb-0" href="{{ route('forgotpassword') }}">Forgot
                                    Password?</a>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-4">
                                <h6 class="f-w-500 mb-0">Don't have an Account?</h6>
                                <a href="{{ route('register') }}" class="link-primary">Create Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
