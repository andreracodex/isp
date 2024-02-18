<header id="home">
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-light default">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frontend') }}">
                <img src="{{ asset('/images/logo.png') }}" width="100" alt="logo" />
            </a>
            <button class="navbar-toggler rounded" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-start">
                    <li class="nav-item">
                        <a class="btn btn btn-primary" target="_blank" href="{{ route('login') }}">Member Area<i
                                class="ti ti-door-enter"></i></a>
                        @auth
                        <a class="btn btn btn-outline-primary" target="_blank" href="{{ route('dashboard') }}">Dashboard<i
                            class="ti ti-door-enter"></i></a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Nav ] end -->
    <!-- [ Container ] start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.2s">Layanan Internet Terbaik <span
                        class="hero-text-gradient">GNet Provider ISP </span> Kesayangan Kamu..</h1>
                <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-md-8">
                        <p class="text-muted f-16 mb-0">Rasakan kecepatan internet tanpa batas untuk pengalaman online yang luar biasa.
                            Nikmati streaming dan gaming tanpa gangguan dengan kecepatan tinggi yang konsisten.
                        </p>
                    </div>
                </div>
                <div class="my-4 my-sm-5 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="#" class="btn btn-primary">Hubungi Kami Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</header>
