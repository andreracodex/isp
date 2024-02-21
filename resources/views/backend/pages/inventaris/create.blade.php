@extends('backend.base')

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
                        <h2 class="mb-0">Tambah Paket Internet</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Paket Form</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('paket.store') }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                        @csrf
                        @include('backend.pages.inventaris.partials.form-control-inventaris', [
                            'submit' => 'Create',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
