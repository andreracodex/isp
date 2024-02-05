@extends('layouts.backend.base')

@section('styles')
@endsection

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Sales Order</h4>
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

    <section class="datatables">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order" style="width:100%"
                            class="table table-hover table-bordered datatable-select-inputs text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Waktu Order</th>
                                    <th>Kode Order</th>
                                    @can('view order')
                                        <th>Customer</th>
                                    @endcan
                                    {{-- <th>Metode Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Bukti Pembayaran</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#order').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('order.index') }}",
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-clipboard"></i>',
                        title: 'Data Order',
                        titleAttr: 'Copy Clipboard',
                        className: 'btn btn-rounded btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Order',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-rounded btn-warning',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Order',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-rounded btn-success',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Order',
                        titleAttr: 'Export PDF',
                        className: 'btn btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ], // Ini Option supaya semua
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    @can('view order')
                        {
                            data: 'customer_id',
                            name: 'customer_id'
                        },
                    @endcan
                    // {
                    //     data: 'payment_id',
                    //     name: 'payment_id'
                    // },
                    // {
                    //     data: 'payment_status',
                    //     name: 'payment_status',
                    //     render: function(data, type, row) {
                    //         if (row.payment_status == 0) {
                    //             return '<span class="mb-1 badge rounded-pill bg-primary">Belum Dibayar</span>';
                    //         } else if (row.payment_status == 1) {
                    //             return '<span class="mb-1 badge rounded-pill bg-warning">DP</span>';
                    //         } else {
                    //             return '<span class="mb-1 badge rounded-pill bg-success">Terbayar</span>';
                    //         }
                    //     }
                    // },
                    // {
                    //     data: 'payment_proof',
                    //     name: 'payment_proof'
                    // },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (row.status == 0) {
                                return '<span class="mb-1 badge rounded-pill bg-primary">Proses</span>';
                            } else if (row.status == 1) {
                                return '<span class="mb-1 badge rounded-pill bg-warning">Dikirim Sebagian</span>';
                            } else if (row.status == 2) {
                                return '<span class="mb-1 badge rounded-pill bg-secondary">Dikirim</span>';
                            } else {
                                return '<span class="mb-1 badge rounded-pill bg-success">Selesai</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
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
            @can('add order')
                table.button().add(4, {
                    action: function(e, dt, button, config) {
                        dt.ajax.reload();
                    },
                    text: '<i class="fa fa-sync-alt"></i>',
                    className: 'btn btn-rounded btn-dark',
                    titleAttr: 'Refresh Table',
                });
            @endcan
            table.button().add(6, {
                action: function(e, dt, button, config) {
                    window.location.href = '{{ route('order.create') }}';
                },
                text: '<a class="tambah text-white"><b> + </b>Order</a>',
                className: 'btn btn-rounded tambah',
                titleAttr: 'Add Order',
            });
        });
    </script>
@endpush
