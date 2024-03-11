@extends('backend.base')

@section('title', 'Inventory View')

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
                        <h2 class="mb-0">Detail Inventaris</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('view customer')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Inventaris</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Nama Barang</p>
                                        <p class="mb-0">
                                            {{ $inve->nama_barang }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Lokasi Inventaris</p>
                                        <p class="mb-0">
                                            @if ($inve->location_id != null)
                                                {{ $inve->location->nama_location }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Jenis Barang</p>
                                        <p class="mb-0">
                                            @if ($inve->jenis_id != null)
                                                {{ $inve->kategori->nama }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Jumlah Barang</p>
                                        <p class="mb-0">
                                            {{ number_format($inve->jumlah_barang, 0, ',', '.'); }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Satuan Barang</p>
                                        <p class="mb-0">
                                            @if ($inve->satuan_id != null)
                                                {{ $inve->satuan->nama }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('inve.edit', $inve->id) }}" class="btn btn-warning btn-round">
                            <i class='fa fa-pencil-alt'></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
