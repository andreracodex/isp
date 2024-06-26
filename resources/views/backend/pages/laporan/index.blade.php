@extends('backend.base')

@section('title', 'Tagihan Data')

@section('styles')
@endsection

@push('script')
    <script src="{{ asset('/js/plugins/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.fn.DataTable.ext.errMode = 'throw';

            var customerid = $('#customer_id').val();
            var tempo = $('#jatuh_tempo').val();
            var status = $('#status_tagihan').val();

            // console.log(customerid, tempo);

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

            let table = $('#order').DataTable({
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
                        .column(7, {
                            search: 'applied'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var number = total;
                    let formatted = formatRupiah(number);

                    // Update footer
                    $(api.column(7).footer()).html(
                        '<span class="badge bg-light-danger rounded-pill f-12">' + formatted +
                        '</span>');
                },
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: false,
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('laporan.index') }}",
                    type: "GET",
                    data: function(d) {
                        // console.log(customerid);
                        // console.log(tempo);
                        // console.log(status);
                        d.customerid = customerid;
                        d.tempo = tempo;
                        d.status = status;
                        return d
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Do something here
                        console.log(errorThrown);
                        console.log(textStatus);
                        console.log(jqXHR);
                    }
                },
                buttons: [
                    'colvis',
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>  Print Data',
                        title: 'Data Customer',
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
                    [1, 'asc']
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
                    orderable: false,
                    searchable: false,
                    checkboxes: {
                        selectRow: true
                    },
                }, {
                    target: 4,
                    visible: false,
                    searchable: false
                }],
                // Ini Option supaya semua
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_customer',
                        name: 'nama_customer',
                        render: function(data, type, row) {
                            if (row.nama_customer != null) {
                                return '<div class="row"><div class="col-auto pe-0"><img src="{{ asset('/images/user/avatar-1.jpg') }}" alt="user-image" class="wid-40 rounded-circle"></div><div class="col"><h6 class="mb-0">' +
                                    row.nama_customer +
                                    '</h6><p class="text-danger f-12 mb-0">GDN-' +
                                    row.nomor_layanan + '</p></div></div>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'nama_location',
                        name: 'nama_location',
                        render: function(data, type, row) {
                            if (row.nama_location != null) {
                                return '<div class="row"><div class="col"><h6 class="mb-0">' +
                                    row.alamat_customer + '</h6><p class="text-danger f-12 mb-0">' +
                                    row.nama_location + '</p></div></div>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'nomor_telephone',
                        name: 'nomor_telephone'
                    },
                    {
                        data: 'jenis_paket',
                        name: 'jenis_paket',
                        render: function(data, type, row) {
                            if (row.jenis_paket != null) {
                                return '<span class="badge bg-light-primary rounded-pill f-12">' +
                                    row.jenis_paket + '</span>';
                            } else {
                                return '<span class="badge bg-light-danger rounded-pill f-12"> - </span>';
                            }
                        }
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

            $('#customer_id').on('change', function(selected) {
                customerid = $('#customer_id').val();
                // console.log(customerid);
                $('#order').DataTable().ajax.reload()
            });

            $('#jatuh_tempo').on('change', function(selected) {
                tempo = $('#jatuh_tempo').val();
                // console.log(tempo);
                $('#order').DataTable().ajax.reload()
            });

            $('#status_tagihan').on('change', function(selected) {
                status = $('#status_tagihan').val();
                // console.log(tempo);
                $('#order').DataTable().ajax.reload()
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
@endpush

@section('isi')
    {{-- Breadcrumbs --}}
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Laporan Bulanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="headerbutton">
                        <div>
                            {{-- <a href="{{ route('customer.create') }}" type="button"
                                class="btn btn-sm btn-outline-primary d-inline-flex"><i
                                    class="ti ti-plus me-1"></i>Tagihan</a> --}}
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
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2" required>
                                    <option value="0">All Customer</option>
                                    @foreach ($customer as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->nama_customer }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip" style="top: 0">Status Aktif required</div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-3">
                            <div class="mb-3">
                                <label class="form-label headerbutton">Jatuh Tempo
                                </label>
                                <select name="jatuh_tempo" id="jatuh_tempo" class="form-control select2" required>
                                    <option value="0">All Tempo</option>
                                    @foreach ($date as $jatuh)
                                        <option value="{{ $jatuh->id }}">
                                            {{ \Carbon\Carbon::parse($jatuh->bulan_periode)->format('F Y') }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip" style="top: 0">Status Aktif required</div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2">
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
                        <table id="order" class="table compact table-striped table-hover table-bordered wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>No</th>
                                    <th>Customer & ID</th>
                                    <th>Alamat & Lokasi</th>
                                    <th>Telpon</th>
                                    <th>Paket</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Tagihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" style="text-align:right">Total Tagihan:</th>
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
@endsection
