@extends('backend.base')

@section('title', 'Forgot Password')


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
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <a href="{{ route('frontend') }}"><img src="{{ asset('/images/logo.png') }}" width="150"
                                    class="mb-4 img-fluid" alt="img"></a>
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Forgot Password</b></h3>
                                <a href="{{ route('login') }}" class="link-primary">Back to Login</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" :value="old('email')" class="form-control" id="floatingInput" placeholder="Email Address" required>
                            </div>
                            <p class="mt-4 text-sm text-muted">Do not forgot to check SPAM box.</p>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Send Password Reset Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
