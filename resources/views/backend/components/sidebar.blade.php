<!-- Sidebar scroll-->
<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('frontend') }}" class="text-nowrap logo-img">
            <img src="{{ asset($data[2]->value) }}" class="dark-logo" width="180" alt="" />
        </a>
        <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8 text-muted"></i>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
        <ul id="sidebarnav">
            <!-- ============================= -->
            <!-- Home -->
            <!-- ============================= -->
            @can('menu dashboard')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-activity-heartbeat"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
            @endcan

            <!-- ============================= -->
            <!-- Apps -->
            <!-- ============================= -->
            @can('menu sales')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Sales</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-currency-dollar"></i>
                        </span>
                        <span class="hide-menu">Sales</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('main salesorder')
                            <li class="sidebar-item">
                                <a href="{{ route('order.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Sales Order</span>
                                </a>
                            </li>
                        @endcan
                        {{-- @can('menu payment')
                            <li class="sidebar-item">
                                <a href="{{ route('payment.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Payment Method</span>
                                </a>
                            </li>
                        @endcan --}}
                    </ul>
                </li>
            @endcan

            {{-- ========================= --}}
            {{-- CUSTOMER MENU --}}
            {{-- =========================  --}}
            @can('menu customer')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Customer</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Customer</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('main customer')
                            <li class="sidebar-item">
                                <a href="{{ route('customer.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Customer List</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan


            {{-- ========================= --}}
            {{--  MENU Product --}}
            {{-- =========================  --}}
            @can('menu product')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Product</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-box"></i>
                        </span>
                        <span class="hide-menu">Product</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('main article')
                            <li class="sidebar-item">
                                <a href="{{ route('productarticle.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Article</span>
                                </a>
                            </li>
                        @endcan
                        @can('main category')
                            <li class="sidebar-item">
                                <a href="{{ route('productcategory.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Category</span>
                                </a>
                            </li>
                        @endcan
                        @can('main product')
                            <li class="sidebar-item">
                                <a href="{{ route('product.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Product List</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    {{-- @endcan --}}
                </li>
            @endcan


            {{-- ==================== --}}
            {{-- Menu Role and Permissions --}}
            {{-- ==================== --}}
            @can('menu setting')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Settings</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-app-window"></i>
                        </span>
                        <span class="hide-menu">Web Setting</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('main setting')
                            <li class="sidebar-item">
                                <a href="{{ route('websetting.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Web Settings</span>
                                </a>
                            </li>
                        @endcan
                        @can('main slider')
                            <li class="sidebar-item">
                                <a href="{{ route('slider.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Sliders Setting</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Role & Permission</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('main role')
                            <li class="sidebar-item">
                                <a href="{{ route('role.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Role</span>
                                </a>
                            </li>
                        @endcan
                        @can('main permission')
                            <li class="sidebar-item">
                                <a href="{{ route('permission.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Permission</span>
                                </a>
                            </li>
                        @endcan
                        @can('main assign')
                            <li class="sidebar-item">
                                <a href="{{ route('assign.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Assign Permission</span>
                                </a>
                            </li>
                        @endcan
                        @can('main userrole')
                            <li class="sidebar-item">
                                <a href="{{ route('userrole.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Assign User Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('main useractivation')
                            <li class="sidebar-item">
                                <a href="{{ route('useraccess.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">User Activation</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>


            @endcan
    </nav>
</div>
<!-- End Sidebar scroll-->
