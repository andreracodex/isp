@extends('layouts.backend.base')

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Slider Setting</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/desktop.webp') }}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('add slider')
        <div class="card">
            <div class="card-header">
                <h5>Create New Slider</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('slider.create') }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    @include('layouts.backend.pages.setting.slider.partials.form-control-slider', [
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
                        <table id="slider" style="width:100%!important"
                            class="table table-hover table-bordered datatable-select-inputs text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Path</th>
                                    <th>Real Path</th>
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

            var table = $('#slider').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('slider.index') }}",
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-clipboard"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Copy Clipboard',
                        className: 'btn btn-rounded btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-rounded btn-warning',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-rounded btn-success',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Customer',
                        titleAttr: 'Export PDF',
                        className: 'btn btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],
                lengthMenu: [
                    [10, -1],
                    [10, "All"]
                ], // Ini Option supaya semua
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, row) {
                            @env('production')
                                var url = 'https://sandalmely.com/public'
                            @endenv
                            @env('local')
                                var url = 'http://sendal.test'
                            @endenv
                            if (row.image === null) {
                                return "<img src='{{ asset('/front/dist/images/slider/carousel-default.jpg') }}' height=\"80\"/>";
                            } else {
                                return '<img src="' + url + data + '" style="height:80px;"/>';
                            }
                        }
                    },
                    {
                        data: 'image_path',
                        name: 'image_path',
                    },
                    {
                        data: 'real_path',
                        name: 'real_path',
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row) {
                            if (row.is_active == 0) {
                                return '<span class="mb-1 badge rounded-pill bg-primary">Not Active</span>';
                            } else {
                                return '<span class="mb-1 badge rounded-pill bg-success">Active</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
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
