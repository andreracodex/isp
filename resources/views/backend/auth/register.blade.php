@extends('backend.base')

@push('script')
@endpush

@section('title', 'Sign Up')

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
                            <a href="{{ route('frontend') }}"><img src="{{ asset('/images/logo.png') }}" width="150"
                                    alt="img"></a>
                            <h5 class="text-center f-w-500 mb-3">Internet Provider Kesayangan Kamu</h5>
                            <div class="d-grid my-3">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="{{ asset('/images/authentication/google.svg') }}" alt="img"> <span> Sign
                                        Up with Google</span>
                                </button>
                            </div>
                        </div>
                        <div class="saprator my-3">
                            <span>OR</span>
                        </div>
                        <form novalidate="" onSubmit="return confirmed(this)" method="POST"
                            action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" :value="old('name')" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="First Name" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="username" :value="old('username')"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="User Name" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" :value="old('email')"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" :value="old('password')"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password_confirmation" :value="old('password_confirmation')"
                                    id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input input-primary @error('terms') is-invalid @enderror"
                                        name="terms" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted" for="terms">I agree to all the Terms
                                        &
                                        Condition</label>
                                    @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-4">
                                <h6 class="f-w-500 mb-0">Already have an Account?</h6>
                                <a href="{{ route('login') }}" class="link-primary">Login to My Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
