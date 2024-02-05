@extends('layouts.backend.base')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Show Article</h4>
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

    <section class="datatables">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 mb-3"><b>Kode Artikel</b></div>
                    <div class="col-lg-9 mb-3">{{ $article->kode_artikel }}</div>

                    <div class="col-lg-3 mb-3"><b>Kode Spon Plong</b></div>
                    <div class="col-lg-9 mb-3">{{ $article->kode_spon_plong }}</div>

                    <div class="col-lg-3 mb-3"><b>Nama Artikel</b></div>
                    <div class="col-lg-9 mb-3">{{ $article->nama_artikel }}</div>

                    <div class="col-lg-3 mb-3"><b>Is Active</b></div>
                    <div class="col-lg-9 mb-3">
                        @if ($article->is_active == 1)
                            <span class="badge rounded-pill bg-success">Active</span>
                        @else
                            <span class="badge rounded-pill bg-primary">Not Active</span>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <a href="{{ route('productarticle.edit', $article->id) }}" class="btn btn-warning">
                            <i class="ti ti-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
