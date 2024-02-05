@extends('layouts.backend.base')

@section('styles')
@endsection

@push('script')
    <script src="{{ asset('back/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('back/dist/js/dashboard5.js') }}"></script> --}}
@endpush

@section('isi')
    <div class="col-12">
        <div class="d-flex align-items-center gap-4 mb-4">
            <div class="position-relative">
                <div class="border border-2 border-primary rounded-circle">
                    @if ($user->real_path == null)
                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}" class='img-fluid rounded-circle'
                            width="60" alt="user Photo">
                    @else
                        <img src="{{ asset('/' . $user->real_path) }}" class='img-fluid rounded-circle'width="60"
                            alt="user Photo">
                    @endif
                </div>
                @if ($notif != 0)
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">{{ $notif }}
                        - Notif<span class="visually-hidden">unread messages</span>
                    </span>
                @else
                @endif
            </div>
            <div>
                <h3 class="fw-semibold">Hi, <span class="text-dark">{{ Auth::user()->name }}</span>
                </h3>
                <span>Selamat datang, and happy this day</span>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="col-12">
        {{-- Chart Sales --}}
        <div class="card">
            <div class="card-body">
                <div class="row pb-4">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="d-flex flex-column align-items-start w-100">
                            <div class="text-start">
                                <h5 class="card-title fw-semibold">Sales Order Chart</h5>
                                <span>{{ \Carbon\Carbon::now()->format('d/M/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="w-100" style="width: 100%;">
                            {{-- <div class="d-md-flex align-items-start gap-3">
                                <div>
                                    <h6 class="mb-0">Product Condition</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <h2 class="mt-2 fw-bold">75%</h2>
                                        <span class="badge bg-primary  px-2 py-1 d-flex align-items-center">
                                            <i class="ti ti-chevron-down fs-4"></i>2.8% </span>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <select class="form-select">
                                        <option value="1">2023</option>
                                        <option value="2">2022</option>
                                        <option value="3">2021</option>
                                        <option value="4">2020</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div id="grafikOrder">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="row gx-0">
                    <div class="col-md-3 border-end">
                        <div class="p-4 py-3 py-md-3">
                            <p class="fs-4 text-primary mb-0">
                                <span class="text-primary">
                                    <span class="round-8 bg-primary rounded-circle d-inline-block me-1"></span>
                                </span>Sales Order (Year)
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $totalOrder }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="p-4 py-3 py-md-3">
                            <p class="fs-4 text-warning mb-0">
                                <span class="text-warning">
                                    <span class="round-8 bg-warning rounded-circle d-inline-block me-1"></span>
                                </span>Partial Ship Order (Year)
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $totalOrderPartialKirim }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="p-4 py-3 py-md-3">
                            <p class="fs-4 text-secondary mb-0">
                                <span class="text-secondary">
                                    <span class="round-8 bg-secondary rounded-circle d-inline-block me-1"></span>
                                </span>Completed Order (Year)
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $totalOrderCompleted }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="p-4 py-3 py-md-3">
                            <p class="fs-4 text-success mb-0">
                                <span class="text-success">
                                    <span class="round-8 bg-success rounded-circle d-inline-block me-1"></span>
                                </span>Closed Sales Order (Year)
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $totalOrderKirim }}</h3>
                        </div>
                    </div>
                    {{-- <div class="col-md-2 border-end">
                        <div class="p-4 py-3 py-md-3">
                            <p class="fs-4 text-danger mb-0">
                                <span class="text-danger">
                                    <span class="round-8 bg-danger rounded-circle d-inline-block me-1"></span>
                                </span>Total Order Item (Year)
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $totalOrderItemTahunIni }}</h3>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel --}}
    <div class="owl-carousel counter-carousel owl-theme owl-rtl owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-primary shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-user-male.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-info mb-1">Active User</p>
                                    <h5 class="fw-semibold text-info mb-0">{{ $users }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-warning shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-briefcase.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-warning mb-1">Customer (Active)</p>
                                    <h5 class="fw-semibold text-warning mb-0">{{ $cust }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-danger shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-pie.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-danger mb-1">Sales Order (Month)</p>
                                    <h5 class="fw-semibold text-danger mb-0">{{ $totalOrderMonth }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-info shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-dd-invoice.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-info mb-1">Sold Item (Month)</p>
                                    <h5 class="fw-semibold text-info mb-0">{{ $totalOrderItemMonth }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-warning shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-dd-date.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-warning mb-1">Partial Ship (Month)</p>
                                    <h5 class="fw-semibold text-warning mb-0">{{ $totalClosedOrderBulanIni }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item">
                    <div class="item">
                        <div class="card border-0 zoom-in bg-light-success shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('back/dist/images/svgs/icon-speech-bubble.svg') }}" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-success mb-1">Closed SO (Month) </p>
                                    <h5 class="fw-semibold text-success mb-0">{{ $totalClosedOrderBulanIni }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="owl-nav disabled" id="owl-nav">
            <button type="button" aria-hidden="true" title="prev" role="presentation" class="owl-prev">
                <span aria-label="Previous"> ‹ </span>
            </button>
            <button type="button" aria-hidden="true" title="next" role="presentation" class="owl-next">
                <span aria-label="Next"> › </span>
            </button>
        </div>
        <div class="owl-dots disabled" id="owl-disabled">
            <button title="active" role="button" aria-label="active" class="owl-dot active">
                <span></span>
            </button>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Produk Terlaris</h5>
                <p class="card-subtitle">Produk yang Paling Diminati Pelanggan</p>

                @foreach ($produkTerlaris as $terlaris)
                    <div class="py-2 d-flex align-items-center">
                        <div class="bg-shadow">
                            @if ($terlaris->image_path != null)
                                <img src="{{ asset('/' . $terlaris->image_path) }}"
                                    style="border-radius: 10px; width: 50px;" alt="user Photo">
                            @else
                                <img src="{{ asset('/front/dist/images/produk/no-image-color.png') }}"
                                    style="border-radius: 10px; width: 50px;" alt="user Photo">
                            @endif
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-semibold">
                                {{ $terlaris->product->article->nama_artikel . ' - ' . $terlaris->product->category->kode_size_fg }}
                            </h6>
                        </div>
                        <div class="ms-auto">
                            <span class="fs-3">{{ $terlaris->total_quantity }} terjual</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center mb-9">
                    <div>
                        <h5 class="card-title fw-semibold">Sales Order Status

                        </h5>
                        <p class="card-subtitle">List Item Order yang <i class="text-primary"> <b>Proses</b> </i> dan
                            <i class="text-warning"> <b>Kirim</b>
                        </p>
                        <h3>
                            <div>
                                <a href="{{ route('order.index') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i>
                                    Show All Order</a></i>
                            </div>
                        </h3>
                    </div>
                    <div class="ms-auto mt-4 mt-md-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                    <span>Proses</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                    <span>Dikirim</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                    <span>Packed</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 text-nowrap" id="order_view">
                                <tbody>
                                    @foreach ($orderProses as $proses)
                                        <tr>
                                            <td class="ps-0 text-center">
                                                <span class="mb-0">
                                                    {{ \Carbon\Carbon::parse($proses->created_at)->format('d M Y') }}
                                                </span>
                                            </td>
                                            <td class="ps-0 text-center">
                                                <span class="mb-0">
                                                    {{ $proses->customer->nama_customer }}
                                                </span>
                                            </td>
                                            <td class="ps-0">
                                                <h6 class="mb-0"><b>OR-00{{ $proses->id }}</b></h6>
                                            </td>
                                            <td class="ps-0">
                                                {{ \App\Models\OrderItem::where('order_id', $proses->id)->count() }} item
                                            </td>
                                            <td class="ps-0">
                                                <span class="mb-1 badge rounded-pill bg-primary">
                                                    Proses
                                                </span>
                                            </td>
                                            <td class="ps-0">
                                                <a href="{{ route('order.show', $proses->uuid) }}"
                                                    class="example-popover btn btn-sm btn-dark" data-container="body"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="ps-0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="flex-shrink-0">
                                                        @if ($proses->image_path != null)
                                                            <img src="{{ asset('/' . $proses->image_path) }}"
                                                                style="border-radius: 10px; width: 50px;"
                                                                alt="user Photo">
                                                        @else
                                                            <img src="{{ asset('/front/dist/images/produk/no-image-color.png') }}"
                                                                style="border-radius: 10px; width: 50px;"
                                                                alt="user Photo">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ $proses->product->nama_finishing_good }}
                                                        </h6>
                                                        <span class="fs-2">OR-00{{ $proses->order_id }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="ps-0">
                                                <h6 class="mb-0">{{ $proses->quantity }} Krg</h6>
                                            </td>
                                            <td class="ps-0 text-center">
                                                <span
                                                    class="mb-0">{{ \Carbon\Carbon::parse($proses->created_at)->format('d/F/Y') }}</span>
                                            </td>
                                            <td class="ps-0">
                                                <span class="mb-1 badge rounded-pill bg-primary">
                                                    Proses
                                                </span>
                                            </td>
                                            <td class="ps-0">
                                                <button class="example-popover btn btn-sm btn-warning updateKirim"
                                                    data-id="{{ $proses->id }}"><i class="fa fa-paper-plane"></i>
                                                    Kirim</button>
                                            </td>
                                        </tr> --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-nowrap">
                                <tbody>
                                    @foreach ($orderDikirim as $kirim)
                                        <tr>
                                            <td class="ps-0 text-center">
                                                <span class="mb-0">
                                                    {{ \Carbon\Carbon::parse($kirim->created_at)->format('d M Y') }}
                                                </span>
                                            </td>
                                            <td class="ps-0 text-center">
                                                <span class="mb-0">
                                                    {{ $kirim->nama_customer }}
                                                </span>
                                            </td>
                                            <td class="ps-0">
                                                <h6 class="mb-0"><b>OR-00{{ $kirim->id }}</b></h6>
                                            </td>
                                            <td class="ps-0">
                                                {{ \App\Models\OrderItem::where('order_id', $kirim->id)->count() }} item
                                            </td>
                                            <td class="ps-0">
                                                <span class="mb-1 badge rounded-pill bg-secondary">
                                                    Dikirim
                                                </span>
                                            </td>
                                            <td class="ps-0">
                                                <a href="{{ route('order.show', $kirim->uuid) }}"
                                                    class="example-popover btn btn-sm btn-dark" data-container="body"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                            {{-- <td class="ps-0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ $kirim->product->nama_finishing_good }}
                                                        </h6>
                                                        <span class="fs-2">OR-00{{ $kirim->order_id }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="ps-0">
                                                <h6 class="mb-0">{{ $kirim->quantity }}
                                                </h6>
                                            </td>
                                            <td class="ps-0 text-center">
                                                <span
                                                    class="mb-0">{{ date('d M Y h:i:s', strtotime($kirim->created_at)) }}</span>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#order_view').on('click', '.updateKirim', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Pengiriman',
                    text: "Apakah anda yakin akan mengirimkan pesanan ini?",
                    icon: 'warning',
                    data: id,
                    showCancelButton: true,
                    confirmButtonColor: '#10bd9d',
                    cancelButtonColor: '#ca2062',
                    confirmButtonText: 'Ya, Kirim !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: "{{ url('orderItem', ['id']) }}",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Pesanan dalam proses pengiriman.',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire('Error', 'Failed to update status', 'error');
                            }
                        });
                    }
                })
            });
        });
    </script>
    <script type="text/javascript">
        var chartBulanan = {{ Js::from($chartBulanan) }};
        var chartPartial = {{ Js::from($chartPartial) }};
        var chartComplete = {{ Js::from($chartComplete) }};
        var chartDoneAll = {{ Js::from($chartDoneAll) }};

        var chart = {
            series: [
            {
                name: "Sales Order",
                data: chartBulanan,
            },{
                name: "Partial Ship",
                data: chartPartial
            },{
                name: "Completed Order",
                data: chartComplete
            },{
                name: "Closed SO",
                data: chartDoneAll
            }],
            chart: {
                toolbar: {
                    show: true,
                },
                type: "line",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
                height: 200,
            },
            colors: [
                "#ca2062",
                "#FFAE1F",
                "#49BEFF",
                "#10bd9d"
            ],
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: true,
            },
            stroke: {
                curve: "smooth",
                width: 3,
            },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0,
                },
            },
            xaxis: {
                categories: [
                    "Januari",
                    "Februari",
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
            },
            yaxis: {
                tickAmount: 4,
            },
            tooltip: {
                theme: "dark",
            },
        };

        var chart = new ApexCharts(document.querySelector("#grafikOrder"), chart);
        chart.render();
    </script>
@endpush
