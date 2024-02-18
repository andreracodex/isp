@extends('backend.base')

@section('styles')
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let table = $('#customer').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                ajax: "{{ route('customer.index') }}",
                buttons: [
                    'colvis',
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-sm btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-sm btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Export PDF',
                        className: 'btn btn-sm btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                order: [
                    [2, 'asc']
                ],
                // Ini Option supaya semua
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'cust_id',
                        name: 'cust_id'
                    },
                    {
                        data: 'nama_customer',
                        name: 'nama_customer'
                    },
                    {
                        data: 'nomor_layanan',
                        name: 'nomor_layanan'
                    },
                    {
                        data: 'location_id',
                        name: 'location_id'
                    },
                    {
                        data: 'alamat_customer',
                        name: 'alamat_customer'
                    },
                    {
                        data: 'nomor_telephone',
                        name: 'nomor_telephone'
                    },
                    {
                        data: 'paket_id',
                        name: 'paket_id'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row) {
                            if (row.is_active == 0) {
                                return '<span class="mb-1 badge rounded-pill bg-primary"> Not Active </span>';
                            } else if (row.is_active == 1) {
                                return '<span class="mb-1 badge rounded-pill bg-success"> Active </span>';
                            } else {
                                return '<span class="mb-1 badge rounded-pill bg-secondary"> - </span>';
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
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    checkboxes: {
                        selectRow: true
                    }
                }],
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
            table.button().add(3, {
                action: function(e, dt, button, config) {
                    dt.ajax.reload();
                },
                text: '<i class="fa fa-sync-alt"></i>',
                className: 'btn btn-sm btn-rounded btn-primary',
                titleAttr: 'Refresh Table',
            });
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
                        <h2 class="mb-0">Pelanggan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Data Pelanggan</h5>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="customer" class="table compact table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Nomor Layanan</th>
                                    <th>Lokasi Server</th>
                                    <th>Alamat</th>
                                    <th>Telpon</th>
                                    <th>Paket</th>
                                    <th>Harga</th>
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
    </div>
@endsection
