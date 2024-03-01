@extends('backend.base')

@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@push('script')
    <script src="{{ asset('/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/js/pages/dashboard-default.js') }}"></script>
@endpush

@section('isi')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M13 9H7" stroke="#4680FF" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M22.0002 10.9702V13.0302C22.0002 13.5802 21.5602 14.0302 21.0002 14.0502H19.0402C17.9602 14.0502 16.9702 13.2602 16.8802 12.1802C16.8202 11.5502 17.0602 10.9602 17.4802 10.5502C17.8502 10.1702 18.3602 9.9502 18.9202 9.9502H21.0002C21.5602 9.9702 22.0002 10.4202 22.0002 10.9702Z"
                                        stroke="#4680FF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M17.48 10.55C17.06 10.96 16.82 11.55 16.88 12.18C16.97 13.26 17.96 14.05 19.04 14.05H21V15.5C21 18.5 19 20.5 16 20.5H7C4 20.5 2 18.5 2 15.5V8.5C2 5.78 3.64 3.88 6.19 3.56C6.45 3.52 6.72 3.5 7 3.5H16C16.26 3.5 16.51 3.50999 16.75 3.54999C19.33 3.84999 21 5.76 21 8.5V9.95001H18.92C18.36 9.95001 17.85 10.17 17.48 10.55Z"
                                        stroke="#4680FF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Biaya Pasang <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Total biaya pasang bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($biaya_pasang < $biaya_pasang_last)
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @elseif($biaya_pasang == $biaya_pasang_last)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-up text-success"></i>
                                    @endif
                                    {{ $biaya_pasang_conversion }}
                                </h5>
                                <p class="text-primary mb-0">
                                    {{ $biaya_pasang_last_conversion }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z"
                                        stroke="#E58A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path opacity="0.6" d="M14.5 4.5V6.5C14.5 7.6 15.4 8.5 16.5 8.5H18.5" stroke="#E58A00"
                                        stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path opacity="0.6" d="M8 13H12" stroke="#E58A00" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path opacity="0.6" d="M8 17H16" stroke="#E58A00" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Customer Baru <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Total customer baru bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($new_customer < $last_new_customer)
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @elseif($new_customer == $last_new_customer)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-up text-success"></i>
                                    @endif
                                    {{ $new_customer }} Pelanggan
                                </h5>
                                <p class="text-warning mb-0">
                                    {{ $last_new_customer }} Pelanggan Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M14 7.14614C13.5 7.00383 12.6851 6.99859 12 7.00383C11.7709 7.00558 11.9094 6.9944 11.6 7.00383C10.7926 7.03273 10.0016 7.41781 10 8.50882C9.99825 9.67108 11 10.015 12 10.015C13 10.015 14 10.2803 14 11.5211C14 12.4536 13.1925 12.8621 12.1861 12.9974C11.3861 12.9974 11 13.0272 10 12.8838M12 13V14M12 6V7M21 17V17.8C21 18.9201 21 19.4802 20.782 19.908C20.5903 20.2843 20.2843 20.5903 19.908 20.782C19.4802 21 18.9201 21 17.8 21H6.2C5.0799 21 4.51984 21 4.09202 20.782C3.71569 20.5903 3.40973 20.2843 3.21799 19.908C3 19.4802 3 18.9201 3 17.8V17M19 10C19 13.866 15.866 17 12 17C8.13401 17 5 13.866 5 10C5 6.13401 8.13401 3 12 3C15.866 3 19 6.13401 19 10Z"
                                            stroke="#2ca87f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Pendapatan</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($pendapatan < $pendapatan_last)
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @elseif($pendapatan == $pendapatan_last)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-up text-success"></i>
                                    @endif{{ $pendapatan }}
                                </h5>
                                <p class="text-success mb-0">
                                    {{ $pendapatan_last }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M6 8H4M6 16H4M6 12H3M7 4.51555C8.4301 3.55827 10.1499 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C10.1499 21 8.4301 20.4417 7 19.4845M14 9.49991C13.5 9.37589 12.6851 9.37133 12 9.37589M12 9.37589C11.7709 9.37742 11.9094 9.36768 11.6 9.37589C10.7926 9.40108 10.0016 9.73666 10 10.6874C9.99825 11.7002 11 11.9999 12 11.9999C13 11.9999 14 12.2311 14 13.3124C14 14.125 13.1925 14.4811 12.1861 14.599C12.1216 14.599 12.0597 14.5991 12 14.5994M12 9.37589L12 8M12 14.5994C11.3198 14.6022 10.9193 14.6148 10 14.4999M12 14.5994L12 16"
                                            stroke="#DC2626" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Pengeluaran</h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">

                                    @if ($pengeluaran < $pengeluaran)
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @elseif($pengeluaran == $pengeluaran)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-up text-success"></i>
                                    @endif

                                    {{ $pengeluaran }}
                                </h5>
                                <p class="text-danger mb-0">
                                    {{ $pengeluaran }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Revenue</h5>
                </div>
                <div class="card-body">
                    <h5 class="text-end my-2">5.44% <span class="badge bg-success">+2.6%</span> </h5>
                    <div id="customer-rate-graph"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body border-bottom pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Transactions</h5>
                        <div class="dropdown">
                            <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical f-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="analytics-tab-1" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                                aria-controls="analytics-tab-1-pane" aria-selected="true">All
                                Transaction</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-2" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                                aria-controls="analytics-tab-2-pane" aria-selected="false">Success</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-3" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-3-pane" type="button" role="tab"
                                aria-controls="analytics-tab-3-pane" aria-selected="false">Pending</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="analytics-tab-1-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-1" tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border"> AI </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Apple Inc.</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T00232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">$210,000</h6>
                                                <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="10,000 Tracks"><span>SM</span></div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Spotify Music</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T10232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">- 10,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-primary" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>MD</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Medium</h6>
                                                <p class="text-muted mb-0"><small>06:30 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">-26</h6>
                                                <p class="text-warning mb-0"><i class="ti ti-arrows-left-right"></i> 5%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts"><span>U</span> </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Uber</h6>
                                                <p class="text-muted mb-0"><small>08:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-warning" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>OC</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Ola Cabs</h6>
                                                <p class="text-muted mb-0"><small>07:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-2" tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts"><span>U</span> </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Uber</h6>
                                                <p class="text-muted mb-0"><small>08:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-warning" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>OC</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Ola Cabs</h6>
                                                <p class="text-muted mb-0"><small>07:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border">AI</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Apple Inc.</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T00232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">$210,000</h6>
                                                <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="10,000 Tracks"><span>SM</span></div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Spotify Music</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T10232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">- 10,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-primary" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>MD</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Medium</h6>
                                                <p class="text-muted mb-0"><small>06:30 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">-26</h6>
                                                <p class="text-warning mb-0"><i class="ti ti-arrows-left-right"></i> 5%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="analytics-tab-3-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-3" tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="10,000 Tracks"><span>SM</span></div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Spotify Music</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T10232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">- 10,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-primary" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>MD</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Medium</h6>
                                                <p class="text-muted mb-0"><small>06:30 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">-26</h6>
                                                <p class="text-warning mb-0"><i class="ti ti-arrows-left-right"></i> 5%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts"><span>U</span> </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Uber</h6>
                                                <p class="text-muted mb-0"><small>08:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border"> AI </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Apple Inc.</h6>
                                                <p class="text-muted mb-0"><small>#ABLE-PRO-T00232</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">$210,000</h6>
                                                <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border bg-light-warning" data-bs-toggle="tooltip"
                                            data-bs-title="143 Posts">
                                            <span>OC</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Ola Cabs</h6>
                                                <p class="text-muted mb-0"><small>07:40 pm</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">+210,000</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10.6%
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button class="btn btn-outline-secondary d-grid"><span class="text-truncate w-100">View
                                        all Transaction
                                        History</span></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button class="btn btn-primary d-grid"><span class="text-truncate w-100">Create new
                                        Transaction</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Total Income</h5>
                        <div class="dropdown">
                            <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical f-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                            </div>
                        </div>
                    </div>
                    <div id="total-income-graph"></div>
                    <div class="row g-3 mt-3">
                        <div class="col-sm-6">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-primary rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Income</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">$23,876 <small class="text-muted"><i class="ti ti-chevrons-up"></i>
                                        +$763,43</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-warning rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Rent</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">$23,876 <small class="text-muted"><i class="ti ti-chevrons-up"></i>
                                        +$763,43</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-success rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Download</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">$23,876 <small class="text-muted"><i class="ti ti-chevrons-up"></i>
                                        +$763,43</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-light-primary rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Views</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">$23,876 <small class="text-muted"><i class="ti ti-chevrons-up"></i>
                                        +$763,43</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
