@extends('backend.base')

@section('title', 'Tagihan View')

@section('styles')

@endsection


@push('script')
    <script src="{{ asset('/js/plugins/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.fn.DataTable.ext.errMode = 'throw';

            var tempo = $('#jatuh_tempo').val();
            var status = $('#status').val();

            function formatRupiah(angka) {
                var number_string = angka.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return 'Rp ' + rupiah;
            };

            let table = $('#orderdetail').DataTable({
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[^\d]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(3, {
                            search: 'applied'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var number = total;
                    let formatted = formatRupiah(number);

                    // Update footer
                    $(api.column(3).footer()).html(
                        '<span class="badge bg-light-danger rounded-pill f-12">' + formatted +
                        '</span>');
                },
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('order.view', $order->id) }}",
                    type: "GET",
                    data: function(d) {
                        d.tempo = tempo;
                        d.status = status;
                        return d
                    }
                },
                buttons: [
                    'colvis',
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>  Print Data',
                        title: 'Data Order Detail',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-sm btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    // {
                    //     extend: 'pdfHtml5',
                    //     text: '<i class="fa fa-file-pdf"></i>',
                    //     title: 'Data Customer',
                    //     titleAttr: 'Export PDF',
                    //     className: 'btn btn-sm btn-rounded btn-primary',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     },
                    // },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                order: [
                    [2, 'asc']
                ],
                select: {
                    style: 'multi',
                    selector: '.select-checkbox',
                    items: 'row',
                },
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                },
                columnDefs: [{
                        targets: 0,
                        className: 'orderdetail',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        targets: 1,
                        orderable: false,
                        searchable: false,
                        checkboxes: {
                            selectRow: true
                        }
                    },
                ],
                // Ini Option supaya semua
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'orderdetail_id',
                        name: 'orderdetail_id'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date',
                    },
                    {
                        data: 'harga_paket',
                        name: 'harga_paket'
                    },
                    {
                        data: 'pay_status',
                        name: 'pay_status',
                        render: function(data, type, row) {
                            if (row.pay_status == 0) {
                                return '<span class="badge bg-light-danger rounded-pill f-12"> Belum Lunas </span>';
                            } else if (row.pay_status == 1) {
                                return '<span class="badge bg-light-success rounded-pill f-12"> Lunas </span>';
                            } else {
                                return '<span class="badge bg-light-primary rounded-pill f-12"> Isolir </span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
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

                },
            });

            $('#jatuh_tempo').on('change', function(selected) {
                tempo = $('#jatuh_tempo').val();
                // console.log(tempo);
                $('#orderdetail').DataTable().ajax.reload()
            });

            $('#status_tagihan').on('change', function(selected) {
                status = $('#status_tagihan').val();
                // console.log(tempo);
                $('#orderdetail').DataTable().ajax.reload()
            });

            table.button().add(2, {
                action: function(e, dt, button, config) {
                    dt.ajax.reload();
                },
                text: '<i class="fa fa-sync-alt"></i> Refresh',
                className: 'btn btn-sm btn-rounded btn-primary',
                titleAttr: 'Refresh Table',
            });
            // table.button().add(5, {
            //     action: function(e, dt, button, config) {
            //         window.location = "{{ route('customer.create') }}";
            //     },
            //     text: '<i class="fa fa-plus"></i>',
            //     className: 'btn btn-sm btn-rounded btn-info',
            //     titleAttr: 'Add',
            // });
            table.on("click", "th.select-checkbox", function() {
                if ($("th.select-checkbox").hasClass("selected")) {
                    example.rows().deselect();
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    example.rows().select();
                    $("th.select-checkbox").addClass("selected");
                }
            }).on("select deselect", function() {
                ("Some selection or deselection going on")
                if (example.rows({
                        selected: true
                    }).count() !== example.rows().count()) {
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    $("th.select-checkbox").addClass("selected");
                }
            });
        });
    </script>
    <script src="{{ asset('/js/plugins/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#orderdetail').on('click', '.hapusOrderDetail', function() {
                let idItem = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: "Anda yakin ingin menghapus data ini dari list? Data ini adalah data tagihan ?",
                    icon: 'warning',
                    data: idItem,
                    showCancelButton: true,
                    confirmButtonColor: '#10bd9d',
                    cancelButtonColor: '#ca2062',
                    confirmButtonText: 'Ya, Dihapus !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: "{{ route('orderdetail.delete', ':id') }}".replace(
                                ':id', idItem),
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: idItem,
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Order detail berhasil dihapus',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire('Error', 'Gagal menghapus order detail',
                                    'error');
                                // Handle error
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush

@section('isi')
    @if ($errors->any())
        <div class="alert alert-danger dismiss-text">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Detail Tagihan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('view customer')
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Nama Customer :</p>
                                <p class="mb-0">
                                    {{ $order->customer->nama_customer }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Gender :</p>
                                <p class="mb-0">
                                    @if ($order->gender == '1')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Nomor Telefon :</p>
                                <p class="mb-0">
                                    {{ $order->customer->nomor_telephone }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Kota :</p>
                                <p class="mb-0">
                                    {{ $order->customer->village->district->regency->name }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Kecamatan :</p>
                                <p class="mb-0">
                                    {{ $order->customer->village->district->name }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Kelurahan :</p>
                                <p class="mb-0">
                                    {{ $order->customer->village->name }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Alamat :</p>
                                <p class="mb-0">
                                    {{ $order->customer->alamat_customer }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Nama Paket :</p>
                                <p class="mb-0">
                                    {{ $order->paket->nama_paket }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Harga Paket :</p>
                                <p class="mb-0">
                                    @php
                                        $formatted_price = Number::currency($order->paket->harga_paket, 'IDR', 'id');
                                    @endphp
                                    {{ str_replace(',00', '', $formatted_price) }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Tanggal Pemesanan :</p>
                                <p class="mb-0">
                                    {{ date('d F Y', strtotime($order->created_at)) }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="mb-1 text-primary">Tanggal Pemasangan :</p>
                                <p class="mb-0">
                                    @if ($order->installed_date != null)
                                        {{ date('d F Y', strtotime($order->installed_date)) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('customer.edit', $order->customer_id) }}" class="btn btn-sm btn-primary btn-round">
                            <i class='fa fa-pencil-alt'></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="headerbutton">
                            <div>
                                {{-- <a href="{{ route('customer.create') }}" type="button"
                                    class="btn btn-sm btn-outline-primary d-inline-flex"><i
                                        class="ti ti-plus me-1"></i>Tagihan</a> --}}
                                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex"><i
                                        class="ti ti-inbox me-1"></i>Import Excel</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex"><i
                                        class="fa fa-file-pdf">&nbsp;</i>Ekspor PDF</button>
                                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex"><i
                                        class="fa fa-file-excel">&nbsp;</i>Ekspor Excel</button>
                                <button type="button" class="btn btn-sm btn-outline-warning d-inline-flex"><i
                                        class="ti ti-trash me-1"></i>Hapus Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label headerbutton">Jatuh Tempo
                                    <sup class="mt-2">
                                        <b>
                                            <a href="{{ route('periode.create') }}">
                                                <i class="ti ti-plus me-1"></i>Tambah Periode
                                            </a>
                                        </b>
                                    </sup>
                                </label>
                                <select name="jatuh_tempo" id="jatuh_tempo" class="form-control se" required>
                                    <option value="0">All Tempo</option>
                                    @foreach ($date as $jatuh)
                                        <option value="{{ $jatuh->id }}">
                                            {{ \Carbon\Carbon::parse($jatuh->bulan_periode)->format('F Y') }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip" style="top: 0">Status Aktif required</div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label headerbutton">Status Tagihan
                                    </label>
                                    <select name="status_tagihan" id="status_tagihan" class="form-control select2" required>
                                        <option value="null">All</option>
                                        <option value="0">Belum Lunas</option>
                                        <option value="1">Lunas</option>
                                    </select>
                                    <div class="invalid-tooltip" style="top: 0">Status Aktif required</div>
                                </div>
                            </div>
                        </div>

                        <div class="dt-responsive table-responsive">
                            <table id="orderdetail" class="table compact table-striped table-hover table-bordered wrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th></th>
                                        <th>Jatuh Tempo</th>
                                        <th>Tagihan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right">Total Tagihan:</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
