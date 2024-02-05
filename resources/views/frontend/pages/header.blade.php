<header id="home">
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-light default">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('/images/logo-dark.svg') }}" alt="logo" />
            </a>
            <button class="navbar-toggler rounded" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-start">
                    <li class="nav-item">
                        <a class="btn btn btn-success" target="_blank" href="{{ route('login') }}">Member Area<i
                                class="ti ti-door-enter"></i></a>
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
                <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.2s">Explore One of the <span
                        class="hero-text-gradient">Featured Dashboard</span> Template in Themeforest</h1>
                <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-md-8">
                        <p class="text-muted f-16 mb-0">Able Pro is the one of the Featured admin dashboard template
                            in Envato Marketplace and used by over 2.5K+ Customers
                            wordwide.</p>
                    </div>
                </div>
                <div class="my-4 my-sm-5 wow fadeInUp" data-wow-delay="0.4s">
                    <a href="elements/bc_alert.html" class="btn btn-outline-secondary me-2">Explore Components</a>
                    <a href="dashboard/index.html" class="btn btn-primary">Live Preview</a>
                </div>
                <div class="row g-5 justify-content-center text-center wow fadeInUp" data-wow-delay="0.5s">
                    <div class="col-auto head-rating-block">
                        <div class="star mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                        <h4 class="mb-0">4.7/5 <small class="text-muted f-w-400"> Ratings</small></h4>
                    </div>
                    <div class="col-auto">
                        <h5 class="mb-2"><small class="text-muted f-w-400"> Sales</small></h5>
                        <h4 class="mb-0">2.5K+</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="technology-block">
        <ul class="list-inline mb-0">
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Bootstrap 5">
                <img src="{{ asset('/images/landing/tech-bootstrap.svg') }}" alt="img" class="img-fluid" />
            </li>
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Gulp"><img
                    src="{{ asset('/images/landing/tech-gulp.svg') }}" alt="img" class="img-fluid" /></li>
            <!-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="React 18"
        ><img src="{{ asset('/images/landing/tech-react.svg') }}" alt="img" class="img-fluid"
      /></li>
      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Material UI - TypeScript/JavaScript"
        ><img src="{{ asset('/images/landing/tech-mui.svg') }}" alt="img" class="img-fluid"
      /></li>
      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="CodeIgniter"
        ><img src="{{ asset('/images/landing/tech-codeigniter.svg') }}" alt="img" class="img-fluid"
      /></li>
      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title=".net"
        ><img src="{{ asset('/images/landing/tech-net.svg') }}" alt="img" class="img-fluid"
      /></li> -->
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Figma Design System"><img src="{{ asset('/images/landing/tech-figma.svg') }}" alt="img"
                    class="img-fluid" /></li>
        </ul>
    </div>
</header>
