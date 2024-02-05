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

    @can('edit product')
        <div class="card">
            <div class="card-header">
                <h5>Edit Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', 'product') }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    @include('layouts.backend.pages.product.partials.form-control-product', [
                        'submit' => 'Update',
                    ])
                </form>
            </div>
        </div>
    @endcan
@endsection

@push('script')
    <script src="{{ asset('back/dist/libs/cropper/dist/cropper.min.js') }}"></script>
    <script type="text/javascript">
     $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
    });
    </script>
@endpush
