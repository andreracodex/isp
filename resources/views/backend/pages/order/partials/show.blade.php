@extends('layouts.backend.base')

@section('styles')
@endsection

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Order Detail</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/sales.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden invoice-application">
        <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
            <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar"
                aria-controls="chat-sidebar">
                <i class="ti ti-menu-2 fs-5"></i>
            </button>
            <form class="position-relative w-100">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                    placeholder="Search Contact">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
        </div>
        <div class="d-flex">
            <div class="w-25 d-none d-lg-block border-end user-chat-box">
                <div class="p-3 border-bottom">
                    <form class="position-relative">
                        <input type="search" class="form-control search-invoice ps-5" id="text-srh"
                            placeholder="Search Invoice" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div class="app-invoice">
                    <ul class="overflow-auto invoice-users" style="height: calc(100vh - 262px)" data-simplebar>
                        @foreach ($orderList as $list)
                            <li>
                                <a href="javascript:void(0)"
                                    class="p-3 bg-hover-light-black border-bottom d-flex align-items-start invoice-user listing-user bg-light"
                                    id="invoice-{{ $list->uuid }}" data-invoice-id="{{ $list->uuid }}">
                                    <div
                                        class="btn btn-primary round rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-user fs-6"></i>
                                    </div>
                                    <div class="ms-3 d-inline-block w-75">
                                        <h6 class="mb-0 invoice-customer">{{ $list->customer->nama_customer }}</h6>
                                        <span class="fs-3 invoice-id text-truncate text-body-color d-block w-85">Kode Order:
                                            #OR-00{{ $list->id }}</span>
                                        <span
                                            class="fs-3 invoice-date text-nowrap text-body-color d-block">{{ \Carbon\Carbon::parse($list->created_at)->format('d/M/Y') }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="w-75 w-xs-100 chat-container">
                <div class="invoice-inner-part h-100">
                    <div class="invoiceing-box">
                        <div class="invoice-header d-flex align-items-center border-bottom p-3">
                            <h4 class="font-medium text-uppercase mb-0">Sales Order</h4>
                            <div class="ms-auto">
                                <h4 class="invoice-number">#OR-00{{ $order->id }}</h4>
                            </div>
                        </div>
                        <div class="p-3" id="custom-invoice">
                            @foreach ($orderList as $invoice_list)
                                <div class="invoice-{{ $order->id }}" id="printableArea">
                                    <div class="row pt-3">
                                        <div class="col-md-12">
                                            <div class="">
                                                <address>
                                                    <h6>&nbsp;Dari,</h6>
                                                    <h6 class="fw-bold">&nbsp;{{ $data[19]->value }}</h6>
                                                    <p class="ms-1">
                                                        {{ $data[20]->value }}<br />
                                                        {{ $data[21]->value }}
                                                    </p>
                                                </address>
                                            </div>
                                            <div class="text-end">
                                                <address>
                                                    <h6>Kepada,</h6>
                                                    <h6 class="fw-bold invoice-customer">
                                                        {{ $order->customer->nama_customer }},
                                                    </h6>
                                                    <p class="ms-4">
                                                        @if (Auth()->user()->user_type != 'user')
                                                            {{ $order->customer->kode_customer }},<br />
                                                        @endif
                                                        {{ $order->customer->alamat_customer }}, <br />Kota :
                                                        {{ $order->customer->kota_customer }} -
                                                        {{ $order->customer->kode_pos_customer }}
                                                    </p>
                                                    <p class="mt-4 mb-1">
                                                        <span>Tanggal Order :</span>
                                                        <i class="ti ti-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/F/Y') }}
                                                    </p>
                                                    {{-- <p>
                                                    <span>Due Date :</span>
                                                    <i class="ti ti-calendar"></i>
                                                    25th Jan 2021
                                                </p> --}}
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="{{ route('order.create') }}" class="btn btn-success">
                                                + Order
                                            </a>
                                            <div class="table-responsive mt-5" style="clear: both">
                                                <table style="width: 100%;" id="order_view" class="table table-hover">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th class="text-start">#</th>
                                                            <th class="text-start">Produk</th>
                                                            <th class="text-start">Jumlah</th>
                                                            <th class="text-start">Status</th>
                                                            @can('view order')
                                                                <th class="text-start">Aksi</th>
                                                            @endcan
                                                        </tr>
                                                        <!-- end row -->
                                                    </thead>
                                                    <tbody>
                                                        <!-- start row -->

                                                        <!-- end row -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {{-- <div class="pull-right mt-4 text-end">
                                            <p>Sub - Total amount: $20,858</p>
                                            <p>vat (10%) : $2,085</p>
                                            <hr />
                                            <h3><b>Total :</b> $22,943</h3>
                                        </div> --}}
                                            <div class="clearfix"></div>
                                            <hr />
                                            <div class="text-end">
                                                {{-- <button class="btn btn-danger" type="submit">
                                                    Proceed to payment
                                                </button> --}}

                                                @can('edit order')
                                                    @php
                                                        $cekItemProses = \App\Models\OrderItem::where('order_id', $order->id)
                                                            ->where('status', 0)
                                                            ->exists();

                                                        $cekItemDikirim = \App\Models\OrderItem::where('order_id', $order->id)
                                                            ->where('status', 1)
                                                            ->exists();
                                                    @endphp

                                                    @if ($order->status != 3)
                                                        @if ($order->status == 0 || $order->status == 1)
                                                            @if ($cekItemProses)
                                                                <a class="btn btn-secondary mr-2" data-bs-toggle="modal"
                                                                    data-bs-target="#modalSendAll">
                                                                    <span><i class="fa fa-paper-plane fs-5"></i>
                                                                        Kirim Semua</span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if ($cekItemProses)
                                                                <a class="btn btn-secondary mr-2" data-bs-toggle="modal"
                                                                    data-bs-target="#modalSendAll">
                                                                    <span><i class="fa fa-paper-plane fs-5"></i>
                                                                        Kirim Semua</span>
                                                                </a>
                                                            @endif
                                                        @endif

                                                        @if ($order->status == 2)
                                                            @if ($cekItemDikirim)
                                                                <a class="btn btn-success mr-2" data-bs-toggle="modal"
                                                                    data-bs-target="#modalConfirmAll">
                                                                    <span><i class="fa fa-check fs-5"></i>
                                                                        Konfirmasi Semua</span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if ($cekItemDikirim)
                                                                <a class="btn btn-success mr-2" data-bs-toggle="modal"
                                                                    data-bs-target="#modalConfirmAll">
                                                                    <span><i class="fa fa-check fs-5"></i>
                                                                        Konfirmasi Semua</span>
                                                                </a>
                                                            @endif
                                                        @endif

                                                        @if ($cekItemProses)
                                                            <a class="btn btn-warning mr-2"
                                                                href="{{ route('order.edit', $order->id) }}">
                                                                <span><i class="ti ti-pencil fs-5"></i>
                                                                    Ubah</span>
                                                            </a>
                                                        @endif
                                                        {{-- <a class="btn btn-warning mr-2" data-bs-toggle="modal"
                                                            data-bs-target="#editOrder">
                                                            <span><i class="ti ti-pencil fs-5"></i>
                                                                Ubah</span>
                                                        </a> --}}
                                                    @endif
                                                @endcan

                                                <button class="btn btn-default print-page" type="button">
                                                    <span><i class="ti ti-printer fs-5"></i>
                                                        Cetak</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                        Invoice
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="p-3 border-bottom">
                    <form class="position-relative">
                        <input type="search" class="form-control search-invoice ps-5" id="text-srh"
                            placeholder="Search Invoice">
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div class="app-invoice overflow-auto">
                    <ul class="invoice-users">
                        {{-- Mobile List --}}
                        @foreach ($orderList as $list)
                            <li>
                                <a href="javascript:void(0)"
                                    class="p-3 bg-hover-light-black border-bottom d-flex align-items-start invoice-user listing-user bg-light"
                                    id="invoice-{{ $list->uuid }}" data-invoice-id="{{ $list->uuid }}">
                                    <div
                                        class="btn btn-primary round rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-user fs-6"></i>
                                    </div>
                                    <div class="ms-3 d-inline-block w-75">
                                        <h6 class="mb-0 invoice-customer">{{ $list->customer->nama_customer }}</h6>

                                        <span class="fs-3 invoice-id text-truncate text-body-color d-block w-85">
                                            #OR-00{{ $list->id }}</span>
                                        <span
                                            class="fs-3 invoice-date text-nowrap text-body-color d-block">{{ \Carbon\Carbon::parse($list->created_at)->format('d/M/Y') }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.backend.pages.order.partials.send')
    @include('layouts.backend.pages.order.partials.sendConfirm')
@endsection

@push('script')
    <script src="{{ asset('back/dist/js/apps/jquery.PrintArea.js') }}"></script>
    <script src="{{ asset('back/dist/js/apps/invoice.js') }}"></script>
    <script src="{{ asset('back/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#order_view').DataTable({
                dom: "t",
                deferRender: false,
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('order.show', $order) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'product',
                        name: 'product',
                        orderable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        render: function(data, type, row) {
                            if (row.status == 0) {
                                return '<span class="mb-1 badge rounded-pill bg-primary">Proses</span>';
                            } else if (row.status == 1) {
                                return '<span class="mb-1 badge rounded-pill bg-warning">Dikirim</span>';
                            } else {
                                return '<span class="mb-1 badge rounded-pill bg-success">Selesai</span>';
                            }
                        }
                    },
                    @can('view order')
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        },
                    @endcan
                ],
                "initComplete": function() {
                    $(".dataTables_filter input")
                        .unbind() // Unbind previous default bindings
                        .bind("input", function(e) { // Bind our desired behavior
                            // If the length is 3 or more characters, or the user pressed ENTER, search
                            if (this.value.length > 3 || e.keyCode == 13) {
                                // Call the API search function
                                table.search(this.value).draw();
                            }
                            // Ensure we clear the search if they backspace far enough
                            if (this.value == "") {
                                table.search("").draw();
                            }
                            return;
                        });
                }
            });
        });
    </script>
    <script>
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
                            url: "{{ url('orderitem', ['id']) }}",
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
                                // window.location.reload();
                                Swal.fire('Error', 'Failed to update status', 'error');
                            }
                        });
                    }
                })
            });

            $('#order_view').on('click', '.updateDiterima', function() {
                let idDiterima = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Penerimaan',
                    text: "Apakah anda yakin telah menerima pesanan ini?",
                    icon: 'warning',
                    data: idDiterima,
                    showCancelButton: true,
                    confirmButtonColor: '#10bd9d',
                    cancelButtonColor: '#ca2062',
                    confirmButtonText: 'Ya, Diterima !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: "{{ url('orderitemupdate', ['id']) }}",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: idDiterima,
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Pesanan telah diterima.',
                                    'success'
                                )
                            },
                            error: function(error) {
                                // window.location.reload();
                                Swal.fire('Error', 'Failed to update status', 'error');
                                // Handle error
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
