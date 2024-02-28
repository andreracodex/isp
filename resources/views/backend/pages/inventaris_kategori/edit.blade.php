@extends('backend.base')

@section('title', 'Inventory Category Edit')

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

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Edit Kategori Inventaris</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('edit inventaris')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Kategori Inventaris</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('invekategori.update', $invekategori->id) }}" enctype="multipart/form-data"
                            method="POST" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            @include('backend.pages.inventaris_kategori.partials.form-inventaris_ktg', [
                                'submit' => 'Update',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
