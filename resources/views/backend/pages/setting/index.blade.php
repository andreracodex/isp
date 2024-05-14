@extends('backend.base')

@section('title', 'My Profile')

@section('styles')
    <style type="text/css">
        .dataTables_scrollBody {
            overflow-x: hidden !important;
            overflow-y: auto !important;
        }
    </style>
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
            let table = $('#employee').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: false,
                ajax: "{{ route('settings.index') }}",
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
                        data: 'emp_id',
                        name: 'emp_id'
                    },
                    {
                        data: 'nama_karyawan',
                        name: 'nama_karyawan',
                        render: function(data, type, row) {
                            if (row.nama_karyawan != null) {
                                return '<div class="row"><div class="col-auto pe-0"><img src="images/user/avatar-3.jpg" alt="user-image" class="wid-40 rounded-circle"></div><div class="col"><h6 class="mb-0">' +
                                    row.nama_karyawan + '</h6><p class="text-muted f-12 mb-0">' +
                                    row.gender + '</p></div></div>';
                            } else {
                                return '<div class="row"><div class="col-auto pe-0"><img src="images/user/avatar-3.jpg" alt="user-image" class="wid-40 rounded-circle"></div><div class="col"><h6 class="mb-0">Alberta Robbins</h6><p class="text-muted f-12 mb-0">miza@gmail.com</p></div></div>';
                            }
                        }
                    },
                    {
                        data: 'alamat_karyawan',
                        name: 'alamat_karyawan'
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
                                return '<span class="badge bg-light-danger rounded-pill f-12"> Not Active </span>';
                            } else if (row.is_active == 1) {
                                return '<span class="badge bg-light-success rounded-pill f-12"> Active </span>';
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
@endpush

@section('isi')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body py-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        @can('view profile')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="ti ti-user me-2"></i>Profile
                                </a>
                            </li>
                        @endcan
                        @can('edit profile')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-id me-2"></i>Informasi Personal
                                </a>
                            </li>
                        @endcan
                        @can('view activesessions')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-history me-2"></i>Active Session
                                </a>
                            </li>
                        @endcan
                        @can('edit password')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-lock me-2"></i>Change Password
                                </a>
                            </li>
                        @endcan
                        @can('view rolesettings')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab" href="#profile-5" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-box me-2"></i>Role & Hak Akses
                                </a>
                            </li>
                        @endcan
                        @can('edit websettings')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab" href="#profile-6" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-settings me-2"></i>Web Setting
                                </a>
                            </li>
                        @endcan
                        @can('edit wasettings')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-7" data-bs-toggle="tab" href="#profile-7" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="fab fa-whatsapp" aria-hidden="true">&nbsp;&nbsp;</i>WA Setting
                                </a>
                            </li>
                        @endcan
                        @can('edit wamessages')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-8" data-bs-toggle="tab" href="#profile-8" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="fab fa-whatsapp" aria-hidden="true">&nbsp;&nbsp;</i>WA Messages
                                </a>
                            </li>
                        @endcan
                        @can('edit tripaysettings')
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-9" data-bs-toggle="tab" href="#profile-9" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-settings" aria-hidden="true">&nbsp;&nbsp;</i>Tripay Setting
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-xxl-3">
                            <div class="card">
                                <div class="card-body position-relative">
                                    <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">New</span>
                                    </div>
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img class="rounded-circle img-fluid wid-70"
                                                src="{{ asset(Auth::user()->real_path) }}" alt="User image">
                                        </div>
                                        <h5 class="mb-0">
                                            @if (Auth::user()->name != null)
                                                {{ Auth::user()->name }}
                                            @else
                                                -
                                            @endif
                                        </h5>
                                        <p class="text-muted text-sm">ID:@if (Auth::user()->customer != null)
                                                {{ Auth::user()->customer->nomor_layanan }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                        <hr class="my-3 border border-secondary-subtle">
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-mail me-2"></i>
                                            <p class="mb-0">
                                                @if (Auth::user()->email != null)
                                                    {{ Auth::user()->email }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-phone me-2"></i>
                                            <p class="mb-0">
                                                @if (Auth::user()->user_type != 'admin')
                                                    @if (Auth::user()->customer != null)
                                                        {{ Auth::user()->customer->nomor_telephone }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    @if (Auth::user()->employee != null)
                                                        {{ Auth::user()->employee->nomor_telephone }}
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Detail Customer</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Full Name</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->nama_customer }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->nama_karyawan }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Gender</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->gender }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->gender }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Phone</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->nomor_telephone }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->nomor_telephone }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Kode POS</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->kodepos_customer }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->kodepos_karyawan }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Kecamatan</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->kecamatan_customer }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->kecamatan_karyawan }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Desa</p>
                                                    <p class="mb-0">
                                                        @if (Auth::user()->user_type != 'admin')
                                                            @if (Auth::user()->customer != null)
                                                                {{ Auth::user()->customer->desa_customer }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->employee != null)
                                                                {{ Auth::user()->employee->desa_karyawan }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Alamat</p>
                                            <p class="mb-0">
                                                @if (Auth::user()->user_type != 'admin')
                                                    @if (Auth::user()->customer != null)
                                                        {{ Auth::user()->customer->alamat_customer }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    @if (Auth::user()->employee != null)
                                                        {{ Auth::user()->employee->alamat_karyawan }}
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                    @include('backend.pages.setting.partials.form-personal')
                </div>
                <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                    @include('backend.pages.setting.partials.form-pin')
                </div>
                <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                    @include('backend.pages.setting.partials.form-password')
                </div>
                <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                    @include('backend.pages.setting.partials.form-roles')
                </div>
                <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                    @include('backend.pages.setting.partials.form-setting')
                </div>
                <div class="tab-pane" id="profile-7" role="tabpanel" aria-labelledby="profile-tab-7">
                    @include('backend.pages.setting.partials.form-settingwa')
                </div>
                <div class="tab-pane" id="profile-8" role="tabpanel" aria-labelledby="profile-tab-8">
                    @include('backend.pages.setting.partials.form-settingwamessages')
                </div>
                <div class="tab-pane" id="profile-9" role="tabpanel" aria-labelledby="profile-tab-9">
                    @include('backend.pages.setting.partials.form-settingtripay')
                </div>

            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection

@push('script')
    <!-- Ckeditor js -->
    <script src="{{ asset('/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script>
        (function() {
            ClassicEditor.create(document.querySelector('#editor')).catch((error) => {
                console.error(error);
            });
        })();
    </script>
    <script>
        (function() {
            ClassicEditor.create(document.querySelector('#editor2')).catch((error) => {
                console.error(error);
            });
        })();
    </script>
    <script>
        (function() {
            ClassicEditor.create(document.querySelector('#editor3')).catch((error) => {
                console.error(error);
            });
        })();
    </script>
     <script>
        (function() {
            ClassicEditor.create(document.querySelector('#editor4')).catch((error) => {
                console.error(error);
            });
        })();
    </script>
@endpush
