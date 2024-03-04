@extends('backend.base')

@section('title', 'Inventory Satuan Add')

@section('styles')
@endsection

@push('script')
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
                        <h2 class="mb-0">Tambah Satuan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Tambah Satuan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('invesatuan.store') }}" enctype="multipart/form-data" method="POST"
                        class="needs-validation" novalidate="">
                        @csrf
                        @include('backend.pages.inventaris_satuan.partials.form-inventaris_satuan', [
                            'submit' => 'Create',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
