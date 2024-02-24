@extends('backend.base')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body py-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                role="tab" aria-selected="true">
                                <i class="ti ti-user me-2"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-id me-2"></i>Informasi Personal
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-history me-2"></i>Active Session
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-lock me-2"></i>Change Password
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab" href="#profile-5" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-box me-2"></i>Role & Hak Akses
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab" href="#profile-6" role="tab"
                                aria-selected="false" tabindex="-1">
                                <i class="ti ti-users me-2"></i>Employee
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-xxl-3">
                            <div class="card">
                                <div class="card-body position-relative">
                                    <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">New</span>
                                    </div>
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img class="rounded-circle img-fluid wid-70"
                                                src="{{ Auth::user()->real_path }}" alt="User image">
                                        </div>
                                        <h5 class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->nama_customer }} @else - @endif</h5>
                                        <p class="text-muted text-sm">ID:@if(Auth::user()->customer != null) {{ Auth::user()->customer->nomor_layanan }} @else - @endif</p>
                                        <hr class="my-3 border border-secondary-subtle">
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-mail me-2"></i>
                                            <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->email }} @else - @endif</p>
                                        </div>
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-phone me-2"></i>
                                            <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->nomor_telephone }} @else - @endif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Detail Customer</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Full Name</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->nama_customer}} @else - @endif</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Gender</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->gender}} @else - @endif</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Phone</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->nomor_telephone }} @else - @endif</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Kode POS</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->kodepos_customer }} @else - @endif</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Kecamatan</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->kecamatan_customer }} @else - @endif</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Desa</p>
                                                    <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->desa_customer }} @else - @endif</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Alamat</p>
                                            <p class="mb-0">@if(Auth::user()->customer != null) {{ Auth::user()->customer->alamat_customer}} @else - @endif</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                    @include('backend.pages.setting.profile.partials.form-personal')
                </div>
                <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                    @include('backend.pages.setting.profile.partials.form-pin')
                </div>
                <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                    @include('backend.pages.setting.profile.partials.form-password')
                </div>
                <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                    @include('backend.pages.setting.profile.partials.form-roles')
                </div>
                <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                    @include('backend.pages.setting.profile.partials.form-employees')
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection
