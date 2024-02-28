@extends('backend.base')

@section('title', 'Pelanggan Edit')

@section('styles')
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
                        <h2 class="mb-0">Edit Pelanggan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('edit customer')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Customer</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data"
                            method="POST" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            @include('backend.pages.customer.partials.form-control-customer', [
                                'submit' => 'Update',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
