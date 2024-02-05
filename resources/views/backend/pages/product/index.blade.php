@extends('layouts.backend.base')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('back/dist/libs/cropper/dist/cropper.min.css') }}">
    <style type="text/css">
        #image {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
            border-radius: 50%;
        }

        .modal-lg {
            margin-top: 10%;
            max-width: 1100px !important;
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }
    </style>
@endsection

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

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Product</h4>
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

    @can('add product')
        <div class="card">
            <div class="card-header">
                <h5>Create New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('product.create') }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    @include('layouts.backend.pages.product.partials.form-control-product', [
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
                        <table id="product" style="width:100%"
                            class="table table-hover table-bordered datatable-select-inputs text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pic</th>
                                    <th>Kode</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Satuan</th>
                                    @can('view artikel')
                                        <th>Nama Artikel</th>
                                        <th>Active</th>
                                    @endcan
                                    @can('add product')
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.fn.DataTable.ext.errMode = 'throw';
            var table = $('#product').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollX: true,
                ajax: "{{ route('product.index') }}",
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-clipboard"></i>',
                        title: 'Data Produk',
                        titleAttr: 'Copy Clipboard',
                        className: 'btn btn-rounded btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        title: 'Data Produk',
                        titleAttr: 'Cetak Print',
                        className: 'btn btn-rounded btn-warning',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        title: 'Data Produk',
                        titleAttr: 'Export Excel',
                        className: 'btn btn-rounded btn-success',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        title: 'Data Produk',
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
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'path',
                        name: 'path',
                        render: function(data, type, row) {
                            if (row.path === null) {
                                return "<img src='public/front/dist/images/produk/no-image-color.png' height=\"50\" align=\"center\" valign=\"middle\" style=\"border-radius:10%; text-align:center; \"/>";
                            } else {
                                return "<img src=\"public/" + data +
                                    "\" height=\"50\" align=\"center\" valign=\"middle\" style=\"border-radius:10%; text-align:center; \"/>";
                            }
                        },
                    },
                    {
                        data: 'kode_finishing_good',
                        name: 'kode_finishing_good'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'nama_finishing_good',
                        name: 'nama_finishing_good'
                    },
                    {
                        data: 'satuan_fg',
                        name: 'satuan_fg',
                    },
                    @can('view artikel')
                        {
                            data: 'kode_artikel',
                            name: 'kode_artikel'
                        }, {
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
                    @endcan
                    @can('add product')
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    @endcan
                ]
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
    <script src="{{ asset('back/dist/libs/cropper/dist/cropper.min.js') }}"></script>
    <script type="text/javascript">
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('product.upload') }}",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': base64data
                        },
                        success: function(data) {
                            // console.log(data);
                            $modal.modal('hide');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your crop has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });
        });
        $("#close").click(function() {
            $("#modal").modal('hide');
        });
        $("#exit").click(function() {
            $("#modal").modal('hide');
        });

        $(function() {
            $("#harga_pokok2").keyup(function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
                $("#harga_pokok").val($(this).val());
                $(this).val(format($(this).val()));
            });

            $("#harga_jual2").keyup(function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
                $("#harga_jual").val($(this).val());
                $(this).val(format($(this).val()));
            });
        });

        var format = function(num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted = null;
            if (str.indexOf(",") > 0) {
                parts = str.split(",");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ".") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(".");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
        };
    </script>
@endpush
