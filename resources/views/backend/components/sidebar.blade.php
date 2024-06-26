<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('frontend') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                @if (session()->has('isDark'))
                    <img src="{{ asset($profile[1]->value) }}" width="100" height="40" />
                @else
                    <img src="{{ asset($profile[0]->value) }}" width="100" height="40" />
                @endif
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('/images/user/avatar-1.jpg') }}" alt="user-image"
                                class="user-avtar wid-45 rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <small>{{ Auth::user()->email }}</small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar-s" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('settings.profile-show') }}">
                                <i class="ti ti-user"></i>
                                <span>My Account</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-settings"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-lock"></i>
                                <span>Lock Screen</span>
                            </a>
                            @method('POST') @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('sidebar-logout').submit();">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>

                            <form id="sidebar-logout" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Home</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Office</label>
                    <i class="ti ti-chart-arcs"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('customer.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user-square"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Pelanggan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('paket.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-fatrows"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Paket Internet</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('location.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-flag"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Lokasi Server</span></a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('inve.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                            </svg> </span><span class="pc-mtext">Inventaris</span></a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('order.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-dollar-square"></use>
                            </svg> </span><span class="pc-mtext">Tagihan</span></a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('laporan.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-graph"></use>
                            </svg> </span><span class="pc-mtext">Laporan</span></a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('ticket.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-24-support"></use>
                            </svg> </span><span class="pc-mtext">Ticket</span></a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('blast.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-text-block"></use>
                            </svg> </span><span class="pc-mtext">Blast WA</span></a>
                </li>
                {{-- Settings Section --}}
                <li class="pc-item pc-caption">
                    <label>Settings</label>
                    <i class="ti ti-chart-arcs"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('settings.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-setting-2"></use>
                            </svg> </span><span class="pc-mtext">Pengaturan</span></a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('employee.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user-square"></use>
                            </svg> </span><span class="pc-mtext">Employee</span></a>
                </li>
                {{-- <li class="pc-item pc-hasmenu">
                    <a href="{{ route('paymenttype.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-notification-status"></use>
                            </svg> </span><span class="pc-mtext">Payment Type</span></a>
                </li> --}}
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('bank.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-shield"></use>
                            </svg> </span><span class="pc-mtext">Bank</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
