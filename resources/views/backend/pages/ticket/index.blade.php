@extends('backend.base')

@section('title', 'Ticket Data')

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
            let table = $('#ticket').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('ticket.index') }}",
                buttons: [
                    'colvis',
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>  Print Data',
                        title: 'Data Ticket',
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
                        className: 'customer',
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
                        data: 'ticket_id',
                        name: 'ticket_id'
                    },
                    {
                        data: 'nama_customer',
                        name: 'nama_customer',
                    },
                    {
                        data: 'keterangan_komplain',
                        name: 'keterangan_komplain',
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
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row) {
                            if (row.is_active == 0) {
                                return '<span class="badge bg-light-primary rounded-pill f-12"> Closed </span>';
                            } else if (row.is_active == 1) {
                                return '<span class="badge bg-light-warning rounded-pill f-12"> Complain </span>';
                            } else {
                                return '<span class="badge bg-light-primary rounded-pill f-12"> - </span>';
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

                }
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
            $('#ticket').on('click', '.updateStatusTicket', function() {
                let idItem = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi Status',
                    text: "Anda yakin ingin mengubah status ticket ini?",
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
                            url: "{{ route('ticket.updateStatus', ':id') }}".replace(
                                ':id', idItem),
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: idItem,
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Status ticket berhasil diubah',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire('Error', 'Gagal mengubah status ticket',
                                    'error');
                                // Handle error
                            }
                        });
                    }
                })
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ticket').on('click', '.hapusTicket', function() {
                let idItem = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: "Anda yakin ingin menghapus data ticket ini dari list?",
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
                            url: "{{ route('ticket.delete', ':id') }}".replace(
                                ':id', idItem),
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: idItem,
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Ticket berhasil dihapus',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire('Error', 'Gagal menghapus ticket', 'error');
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
    {{-- Breadcrumbs --}}
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Ticket</h2>
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
                            <a href="{{ route('ticket.create') }}" type="button"
                                class="btn btn-sm btn-outline-primary d-inline-flex"><i
                                    class="ti ti-plus me-1"></i>Ticket</a>
                            @can('import excel')
                                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex"><i
                                        class="ti ti-inbox me-1"></i>Import Excel</button>
                            @endcan
                        </div>
                        <div>
                            @can('exspor pdf')
                                <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex"><i
                                        class="fa fa-file-pdf">&nbsp;</i>Ekspor PDF</button>
                            @endcan
                            @can('exspor excel')
                                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex"><i
                                        class="fa fa-file-excel">&nbsp;</i>Ekspor Excel</button>
                            @endcan
                            <button type="button" class="btn btn-sm btn-outline-warning d-inline-flex"><i
                                    class="ti ti-trash me-1"></i>Hapus Filter</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="ticket" class="table compact table-striped table-hover table-bordered wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Alamat</th>
                                    <th>Telpon</th>
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
