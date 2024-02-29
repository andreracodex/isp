<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5>Advance Settings</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1">Gunakan Secure Protokol</p>
                                <p class="text-muted text-sm mb-0">Browsing Securely ( https ) when
                                    it's necessary</p>
                            </div>
                            <div class="form-check form-switch p-0">
                                <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch"
                                    @if ($usersetting[0]->secure_login == 1) @checked(true) @else @checked(false) @endif>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1">Notifikasi Login</p>
                                <p class="text-muted text-sm mb-0">Notify when login attempted from
                                    other place</p>
                            </div>
                            <div class="form-check form-switch p-0">
                                <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch"
                                    @if ($usersetting[0]->login_notif == 1) @checked(true) @else @checked(false) @endif>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1">Login Approvals</p>
                                <p class="text-muted text-sm mb-0">Approvals is not required when login
                                    from
                                    unrecognized devices.</p>
                            </div>
                            <div class="form-check form-switch p-0">
                                <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch"
                                    @if ($usersetting[0]->login_approved == 1) @checked(true) @else @checked(false) @endif>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5>Recognized Devices</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-2">
                                @if ($ip)
                                    <p class="mb-2">IP: {{ $ip->ip }}</p>
                                    <p class="mb-2">Country Name: {{ $ip->countryName }}</p>
                                    <p class="mb-2">Country Code: {{ $ip->countryCode }}</p>
                                    <p class="mb-2">Region Name: {{ $ip->regionName }}</p>
                                    <p class="mb-2">City Name: {{ $ip->cityName }}</p>
                                    <p class="mb-2">Latitude: {{ $ip->latitude }}</p>
                                    <p class="mb-2">Longitude: {{ $ip->longitude }}</p>
                                @endif
                            </div>
                            <div class="">
                                <div class="text-success d-inline-block me-2">
                                    <i class="fas fa-circle f-10 me-2"></i>
                                    Current Active
                                </div>
                                <a href="#!" class="text-danger"><i class="feather icon-x-circle"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Active Sessions</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($sess as $session)
                        <li class="list-group-item px-0 pt-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="me-2">
                                    <p class="mb-2">IP : {{ $session->ip_address }}</p>
                                    <p class="mb-0 text-muted">{{ $session->user_agent }}</p>
                                </div>
                                @method('POST') @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('session-logout').submit();">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>

                                <form id="session-logout" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body text-end btn-page">
                <div class="btn btn-outline-secondary">Cancel</div>
                <div class="btn btn-primary">Update Settings</div>
            </div>
        </div>
    </div>
</div>
