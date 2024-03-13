@extends('backend.base')

@section('title')
    Dashboard
@endsection

@section('styles')
@endsection
@push('script')
    <script src="{{ asset('/js/plugins/apexcharts.min.js') }}"></script>
    <script type="text/javascript">
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        }

        var income = {{ Js::from($income) }};
        var outcome = {{ Js::from($outcome) }};

        var options = {
            chart: {
                fontFamily: "Inter var, sans-serif",
                type: "area",
                height: 370,
                toolbar: {
                    show: false,
                },
            },
            colors: ["#2ca87f", "#dc2626"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: false,
                    opacityFrom: 0.2,
                    opacityTo: 0,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 3,
            },
            plotOptions: {
                bar: {
                    columnWidth: "45%",
                    borderRadius: 4,
                },
            },
            grid: {
                show: true,
                borderColor: "#F3F5F7",
                strokeDashArray: 2,
            },
            series: [{
                    name: "Income",
                    data: income,
                },
                {
                    name: "Expense",
                    data: outcome
                },
            ],
            xaxis: {
                categories: [
                    "Januari",
                    "Febuari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                title: {
                    text: 'Price in Rupiah',
                },
                labels: {
                    formatter: (value) => {
                        return `Rp ${numberWithCommas(value)}`;
                    },
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#income_vs_expenses"),
            options
        );
        chart.render();
    </script>
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
        <div class="col-md-4">
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
                                            d="M16.755 2H7.24502C6.08614 2 5.50671 2 5.03939 2.16261C4.15322 2.47096 3.45748 3.18719 3.15795 4.09946C3 4.58055 3 5.17705 3 6.37006V20.3742C3 21.2324 3.985 21.6878 4.6081 21.1176C4.97417 20.7826 5.52583 20.7826 5.8919 21.1176L6.375 21.5597C7.01659 22.1468 7.98341 22.1468 8.625 21.5597C9.26659 20.9726 10.2334 20.9726 10.875 21.5597C11.5166 22.1468 12.4834 22.1468 13.125 21.5597C13.7666 20.9726 14.7334 20.9726 15.375 21.5597C16.0166 22.1468 16.9834 22.1468 17.625 21.5597L18.1081 21.1176C18.4742 20.7826 19.0258 20.7826 19.3919 21.1176C20.015 21.6878 21 21.2324 21 20.3742V6.37006C21 5.17705 21 4.58055 20.842 4.09946C20.5425 3.18719 19.8468 2.47096 18.9606 2.16261C18.4933 2 17.9139 2 16.755 2Z"
                                            stroke="#27a077" stroke-width="1.5" />
                                        <path d="M9.5 10.4L10.9286 12L14.5 8" stroke="#27a077" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.5 15.5H16.5" stroke="#27a077" stroke-width="1.5"
                                            stroke-linecap="round" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Tagihan Terbayar <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-original-title="Total tagihan terbayar bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($pembayaran_count > $tagihan_count)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($pembayaran_count == $tagihan_count)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @endif
                                    {{ $pembayaran }}
                                </h5>
                                <p class="text-dark mb-0">
                                    {{ $pembayaran_last }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                                    data-bs-placement="top"
                                    data-bs-original-title="Total tagihan terbayar bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($biaya_pasang_real > $biaya_pasang_last_real)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($biaya_pasang_real == $biaya_pasang_last_real)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @endif
                                    {{ $biaya_pasang }}
                                </h5>
                                <p class="text-primary mb-0">
                                    {{ $biaya_pasang_last }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                            <h6 class="mb-0">Pendapatan <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-original-title="Total pendapatan langganan paket bulan ini">*</sup></h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($pendapatan_real > $pendapatan_last_real)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($pendapatan_real == $pendapatan_last_real)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
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
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-danger">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="dc2626">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.2936 1.25C6.30665 1.25 6.31989 1.25001 6.33334 1.25001L17.7064 1.25C17.9776 1.24997 18.1647 1.24995 18.33 1.26512C20.1682 1.43385 21.581 2.95266 21.736 4.8109C21.75 4.97944 21.75 5.17098 21.75 5.45924L21.75 20.2598C21.75 21.0316 21.2676 21.6151 20.6559 21.8291C20.0393 22.0447 19.2904 21.8818 18.8322 21.2407C18.8155 21.2173 18.7998 21.2064 18.7886 21.2006C18.7763 21.1944 18.7632 21.1914 18.75 21.1914C18.7368 21.1914 18.7237 21.1944 18.7115 21.2006C18.7002 21.2064 18.6845 21.2173 18.6678 21.2407L18.2351 21.846C17.3735 23.0513 15.6265 23.0513 14.7649 21.846C14.5015 21.4776 13.9985 21.4776 13.7351 21.846C12.8735 23.0513 11.1265 23.0513 10.2649 21.846C10.0015 21.4776 9.49851 21.4776 9.23514 21.846C8.37351 23.0513 6.6265 23.0513 5.76486 21.846L5.33217 21.2407C5.31546 21.2173 5.29981 21.2064 5.28856 21.2006C5.27631 21.1944 5.2632 21.1914 5.25 21.1914C5.23681 21.1914 5.2237 21.1944 5.21145 21.2006C5.2002 21.2064 5.18455 21.2173 5.16784 21.2407C4.70958 21.8818 3.96074 22.0447 3.34414 21.8291C2.73237 21.6151 2.25 21.0316 2.25 20.2598V5.49727C2.25 5.48441 2.25 5.47174 2.25 5.45925C2.24998 5.17098 2.24996 4.97945 2.26401 4.8109C2.41897 2.95266 3.83179 1.43385 5.66998 1.26512C5.83534 1.24995 6.02237 1.24997 6.2936 1.25ZM6.33334 2.75001C6.00717 2.75001 5.89475 2.7508 5.80709 2.75884C4.74461 2.85637 3.85765 3.75044 3.75883 4.93555C3.75066 5.0335 3.75 5.15739 3.75 5.49727V20.2598C3.75 20.3208 3.76677 20.3522 3.77879 20.3687C3.79348 20.3888 3.8149 20.4046 3.83932 20.4132C3.8637 20.4217 3.88214 20.42 3.89223 20.4171C3.8973 20.4156 3.91821 20.4094 3.94756 20.3684C4.59285 19.4657 5.90716 19.4657 6.55245 20.3684L6.98514 20.9737C7.24851 21.3421 7.7515 21.3421 8.01487 20.9737C8.8765 19.7683 10.6235 19.7683 11.4851 20.9737C11.7485 21.3421 12.2515 21.3421 12.5149 20.9737C13.3765 19.7683 15.1235 19.7683 15.9851 20.9737C16.2485 21.3421 16.7515 21.3421 17.0149 20.9737L17.4476 20.3684C18.0928 19.4657 19.4072 19.4657 20.0525 20.3684C20.0818 20.4095 20.1026 20.4155 20.1076 20.417C20.1177 20.42 20.1363 20.4217 20.1607 20.4132C20.1851 20.4046 20.2065 20.3888 20.2212 20.3687C20.2332 20.3522 20.25 20.3208 20.25 20.2598V5.49727C20.25 5.15739 20.2493 5.03349 20.2412 4.93554C20.1424 3.75044 19.2554 2.85637 18.1929 2.75884C18.1053 2.7508 17.9928 2.75001 17.6667 2.75001H6.33334ZM9.46969 7.46968C9.76258 7.17678 10.2375 7.17678 10.5304 7.46968L12 8.93936L13.4697 7.46969C13.7626 7.1768 14.2375 7.1768 14.5304 7.46969C14.8232 7.76259 14.8232 8.23746 14.5304 8.53035L13.0607 10L14.5303 11.4697C14.8232 11.7626 14.8232 12.2374 14.5303 12.5303C14.2374 12.8232 13.7626 12.8232 13.4697 12.5303L12 11.0607L10.5304 12.5303C10.2375 12.8232 9.7626 12.8232 9.46971 12.5303C9.17682 12.2374 9.17682 11.7626 9.46971 11.4697L10.9394 10L9.46969 8.53034C9.1768 8.23744 9.1768 7.76257 9.46969 7.46968ZM6.75 15.5C6.75 15.0858 7.08579 14.75 7.5 14.75H16.5C16.9142 14.75 17.25 15.0858 17.25 15.5C17.25 15.9142 16.9142 16.25 16.5 16.25H7.5C7.08579 16.25 6.75 15.9142 6.75 15.5Z"
                                            fill="#d82222" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Tagihan Belum Terbayar <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-original-title="Total tagihan belum terbayar bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($new_customer > $last_new_customer)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($new_customer == $last_new_customer)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z"
                                        stroke="#E58A00" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path opacity="0.6" d="M14.5 4.5V6.5C14.5 7.6 15.4 8.5 16.5 8.5H18.5"
                                        stroke="#E58A00" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path opacity="0.6" d="M8 13H12" stroke="#E58A00" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path opacity="0.6" d="M8 17H16" stroke="#E58A00" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">New Customer <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Total customer bulan ini">*</sup>
                            </h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">
                                    @if ($new_customer > $last_new_customer)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($new_customer == $last_new_customer)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
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
        <div class="col-md-4">
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
                            <h6 class="mb-0">Pengeluaran <sup class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-original-title="Total pengeluaran gaji bulan ini">*</sup></h6>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        <div class="mt-3 row align-items-center">
                            <div class="col-12">
                                <h5 class="mb-1">

                                    @if ($pengeluaran_real > $pengeluaran_last_real)
                                        <i class="ti ti-trending-up text-success"></i>
                                    @elseif($pengeluaran_real == $pengeluaran_last_real)
                                        <i class="ti ti-minus text-primary"></i>
                                    @else
                                        <i class="ti ti-trending-down text-danger"></i>
                                    @endif

                                    {{ $pengeluaran }}
                                </h5>
                                <p class="text-danger mb-0">
                                    {{ $pengeluaran_last }} Bulan Lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Revenue</h5>
                </div>
                <div class="card-body">
                    <div id="income_vs_expenses"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Total Pendapatan & Pengeluaran (Bulan Ini)</h5>
                    </div>
                    <div id="total-income-graph"></div>
                    <div class="row g-3 mt-3">
                        <div class="col-sm-4">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-success rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Pemasukan</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">
                                    {{ Number::currency($pendapatan_real + $biaya_pasang_real, in: 'IDR', locale: 'id') }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="bg-body p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span class="p-1 d-block bg-danger rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Pengeluaran</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">{{ Number::currency($pengeluaran_real, in: 'IDR', locale: 'id') }}</h6>
                            </div>
                        </div>
                        <?php
                        $total_pemasukan = $pendapatan_real + $biaya_pasang_real;
                        $total_pengeluaran = $pengeluaran_real;
                        $total = $total_pemasukan - $total_pengeluaran;
                        ?>
                        <div class="col-sm-4">
                            <div
                                class="@if ($total_pemasukan > $total_pengeluaran) bg-green-100 @else bg-red-100 @endif p-3 rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <span
                                            class="p-1 d-block @if ($total_pemasukan > $total_pengeluaran) bg-success @else bg-danger @endif rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0">Result</p>
                                    </div>
                                </div>
                                <h6 class="mb-0">{{ Number::currency($total, in: 'IDR', locale: 'id') }}</h6>
                            </div>
                        </div>
                    </div>
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
    </div>
@endsection

@push('script')
@endpush
