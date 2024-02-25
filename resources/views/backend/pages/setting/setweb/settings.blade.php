@extends('layouts.backend.base')

@section('title', 'Setting Data')

@push('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#setweb').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('websetting.index') }}",

                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-clipboard"></i>',
                        title: 'Data Setting',
                        titleAttr: 'Copy Clipboard',
                        className: 'btn btn-rounded btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Setting',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-rounded btn-warning',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Setting',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-rounded btn-success',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Setting',
                        titleAttr: 'Export PDF',
                        className: 'btn btn-rounded btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'value',
                        name: 'value'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ],
            });
        });
        $(function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })
    </script>
@endpush

@section('isi')

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Web Setting</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/desktop.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            @can('create setweb')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5>Create New Web Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('websetting.create') }}" method="POST" class="needs-validation"
                                novalidate="">
                                @csrf
                                @include(
                                    'layouts.backend.pages.setting.setweb.partials.form-control-settings',
                                    ['submit' => 'Create']
                                )
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('view setweb')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Web Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="setweb" style="width:100%"
                                    class="table table-hover table-bordered datatable-select-inputs text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name Setting</th>
                                            <th>Value</th>
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
            @endcan

        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection
