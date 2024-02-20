@extends('backend.base')

@section('styles')
@endsection

@push('script')

@endpush

@section('isi')

    <form method="POST" action="{{ route('wa.store') }}" class="needs-validation" novalidate>
    @csrf
    @include('backend.pages.wa.partials.form-control-wa', [
        'submit' => 'Create',
    ])
    </form>
    {{-- Breadcrumbs --}}
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">WA Integration</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="headerbutton">
                        <div>
                            <a href="#" data-pc-animate="blur" type="button" class="btn btn-sm btn-outline-primary d-inline-flex" data-bs-toggle="modal"
                                data-bs-target="#animateModal">
                                <i class="ti ti-plus me-1"></i> Add Number
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="paket" class="table compact table-striped table-hover table-bordered wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th></th>
                                    <th>Nama Paket</th>
                                    <th>Jenis Paket Layanan</th>
                                    <th>Harga Paket Layanan</th>
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
    </div>
@endsection
