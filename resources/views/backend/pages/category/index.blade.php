@extends('layouts.backend.base')

@section('styles')
@endsection

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Category</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/products.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('add category')
        <div class="card">
            <div class="card-header">
                <h5>Create New Product Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('productcategory.create') }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    @include('layouts.backend.pages.category.partials.form-control-product', [
                        'submit' => 'Create',
                    ])
                </form>
            </div>
        </div>
    @endcan

    <section class="datatables">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="category" style="width:100%"
                            class="table table-hover table-bordered datatable-select-inputs text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Ukuran</th>
                                    <th>Ukuran</th>
                                    @can('view category')
                                        <th>Jumlah Lusin Per Karung</th>
                                        <th>Kode Jenis Plong</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    @endcan
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

            // var table = $('#tabel').DataTable();
            var table = $('#category').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('productcategory.index') }}",
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-clipboard"></i>',
                        title: 'Data Kategori',
                        titleAttr: 'Copy Clipboard',
                        className: 'btn btn-rounded btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Kategori',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-rounded btn-warning',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Kategori',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-rounded btn-success',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Kategori',
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
                        data: 'kode_size_fg',
                        name: 'kode_size_fg'
                    },
                    {
                        data: 'size_fg',
                        name: 'size_fg'
                    },
                    @can('view category')
                        {
                            data: 'lusin_per_karung',
                            name: 'lusin_per_karung'
                        }, {
                            data: 'kode_jenisplong',
                            name: 'kode_jenisplong',
                        }, {
                            data: 'is_active',
                            name: 'is_active',
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                if (row.is_active == 1) {
                                    return '<span class="mb-1 badge rounded-pill bg-success">Aktif</span>';
                                } else {
                                    return '<span class="mb-1 badge rounded-pill bg-primary">Tidak Aktif</span>';
                                }
                            }
                        }, {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    @endcan
                ],
            });
            table.button().add(4, {
                action: function(e, dt, button, config) {
                    dt.ajax.reload();
                },
                text: '<i class="fa fa-sync-alt"></i>',
                className: 'btn btn-rounded btn-dark',
                titleAttr: 'Refresh Table',
            });

        });
    </script>
@endpush
