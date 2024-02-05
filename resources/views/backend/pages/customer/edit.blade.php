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
                    <h4 class="fw-semibold mb-8">Customer</h4>
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

    @can('edit customer')
        <div class="card">
            <div class="card-header">
                <h5>Edit Customer</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    @include('layouts.backend.pages.customer.partials.form-control-product', [
                        'submit' => 'Update',
                    ])
                </form>
            </div>
        </div>
    @endcan
@endsection
