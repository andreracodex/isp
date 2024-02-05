<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="ti ti-search"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-lg-flex">
            <li class="nav-item dropdown hover-dd d-none d-lg-block">
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="dropdown">Apps<span class="mt-1"><i
                            class="ti ti-chevron-down"></i></span></a>
                <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0">
                    <div class="row">
                        <div class="col-8">
                            <div class=" ps-7 pt-7">
                                <div class="border-bottom">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="position-relative">
                                                <a href="{{ route('order.index') }}"
                                                    class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                    <div
                                                        class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('back/dist/images/svgs/icon-dd-invoice.svg') }}"
                                                            alt="" class="img-fluid" width="24"
                                                            height="24">
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1 fw-semibold bg-hover-primary">Sales Order
                                                        </h6>
                                                        <span class="fs-2 d-block text-dark">View complete sales
                                                            order</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="position-relative">
                                                <a href="{{ route('product.index') }}"
                                                    class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                                                    <div
                                                        class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('back/dist/images/svgs/icon-dd-cart.svg') }}"
                                                            alt="" class="img-fluid" width="24"
                                                            height="24">
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1 fw-semibold bg-hover-primary">Product Catalog
                                                        </h6>
                                                        <span class="fs-2 d-block text-dark">Show products
                                                            information</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center py-3">
                                    <div class="col-8">
                                        <a class="fw-semibold text-dark d-flex align-items-center lh-1 text-decoration-none"
                                            href="#"><i class="ti ti-help fs-6 me-2"></i>Frequently Asked
                                            Questions</a>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end pe-4">
                                            <button class="btn btn-primary">Check</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 ms-n4">
                            <div class="position-relative p-7 border-start h-100">
                                <h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
                                <ul class="">
                                    <li class="mb-3">
                                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none"
                                            href="{{ route('profile.index') }}">Account Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            {{-- <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="app-chat.html">Chat</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="app-calendar.html">Calendar</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="app-email.html">Email</a>
            </li> --}}
        </ul>
        <div class="d-block d-lg-none">
            <img src="{{ asset('back/dist/images/logos/logo-mely-horizontal.webp') }}" class="dark-logo" width="180"
                alt="" />
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                    aria-controls="offcanvasWithBothOptions">
                    <i class="ti ti-align-justified fs-7"></i>
                </a>
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('back/dist/images/svgs/icon-flag-id.svg') }}" alt=""
                                class="rounded-circle object-fit-cover round-20">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body" data-simplebar>
                                <a href="javascript:void(0)"
                                    class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                    <div class="position-relative">
                                        <img src="{{ asset('back/dist/images/svgs/icon-flag-id.svg') }}"
                                            alt="" class="rounded-circle object-fit-cover round-20">
                                    </div>
                                    <p class="mb-0 fs-3">Indonesia</p>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-bell-ringing"></i>
                            @if ($notif != 0)
                                <div class="notification bg-primary rounded-circle"></div>
                            @endif
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop2">
                            <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                @if ($notif != 0)
                                    <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">{{ $notif }}
                                        New</span>
                                @endif
                            </div>
                            <div class="message-body" data-simplebar>
                                @foreach ($notif_det as $det)
                                    @if (Auth::user()->user_type == 'user')
                                        <a href="{{ route('notif.notifupdate', $det->group_id) }}"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="{{ asset('back/dist/images/breadcrumb/products.webp') }}"
                                                    alt="user" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Sales Order #OR-00{{ $det->group_id }}
                                                </h6>
                                                @if ($det->grouped == 'sales-order')
                                                    <span class="d-block text-small">Thank You, for your order</span>
                                                @else
                                                    <span class="d-block">Notif</span>
                                                @endif
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ route('order.show', $det->uuid) }}"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="{{ asset('back/dist/images/breadcrumb/products.webp') }}"
                                                    alt="user" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Sales Order #OR-00{{ $det->group_id }}
                                                </h6>
                                                @if ($det->grouped == 'sales-order')
                                                    <span class="d-block">Sales Order from Customer </span>
                                                @else
                                                    <span class="d-block">Notif</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="py-6 px-7 mb-1">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <button class="btn btn-sm btn-outline-primary">All Notifications</button>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <button class="btn btn-sm btn-outline-success">Mark All as Read</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="user-profile-img">
                                    @if ($user->real_path == null)
                                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}"
                                            class="img-fluid rounded-circle" width="35" height="35"
                                            alt="Profile Photo">
                                    @else
                                        <img src="{{ asset('/' . $user->real_path) }}" class="rounded-circle"
                                            width="35" height="35" alt="Profile Photo">
                                    @endif
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar>
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    @if ($user->real_path == null)
                                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}"
                                            class='img-fluid rounded-circle' width="80" height="80"
                                            alt="Profile Photo">
                                    @else
                                        <img src="{{ asset('/' . $user->real_path) }}"
                                            class='img-fluid rounded-circle' width="80" height="80"
                                            alt="Profile Photo">
                                    @endif

                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3">{{ Str::ucfirst(Auth::user()->name) }}</h5>
                                        <span
                                            class="mb-1 d-block text-dark">{{ Str::ucfirst(Auth::user()->user_type) }}</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a href="{{ route('profile.index') }}"
                                        class="py-8 px-7 mt-8 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="{{ asset('back/dist/images/svgs/icon-account.svg') }}"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                            <span class="d-block text-dark">Account Settings</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('order.index') }}" class="py-8 px-7 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="{{ asset('back/dist/images/svgs/icon-dd-cart.svg') }}"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold">My Order</h6>
                                            <span class="d-block text-dark">Order and Receipt</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-grid py-4 px-7 pt-8">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-lg">
                                            <i class="ti ti-logout nav-small-cap-icon fs-4"></i>
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                    {{-- <a href="{{ route('logout') }}" class="btn btn-outline-primary">Log Out</a> --}}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
