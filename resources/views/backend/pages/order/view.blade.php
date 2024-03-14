@extends('backend.base')

@section('title', 'Tagihan View')

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
                        <h2 class="mb-0">Detail Tagihan</h2>
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
                        <h5>Detail Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Nama Customer</p>
                                        <p class="mb-0">
                                            {{ $order->customer->nama_customer }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Gender</p>
                                        <p class="mb-0">
                                            @if ($order->gender == '1')
                                                Laki-laki
                                            @else
                                                Perempuan
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Nomor Telefon</p>
                                        <p class="mb-0">
                                            {{ $order->customer->nomor_telephone }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Kota</p>
                                        <p class="mb-0">
                                            {{ $order->customer->village->district->regency->name }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Kecamatan</p>
                                        <p class="mb-0">
                                            {{ $order->customer->village->district->name }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Kelurahan</p>
                                        <p class="mb-0">
                                            {{ $order->customer->village->name }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Alamat</p>
                                        <p class="mb-0">
                                            {{ $order->customer->alamat_customer }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            {{-- Paket --}}
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Nama Paket</p>
                                        <p class="mb-0">
                                            {{ $order->paket->nama_paket }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Harga Paket</p>
                                        <p class="mb-0">
                                            @php
                                                $formatted_price = Number::currency(
                                                    $order->paket->harga_paket,
                                                    'IDR',
                                                    'id',
                                                );
                                            @endphp
                                            {{ str_replace(',00', '', $formatted_price) }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Tanggal Pemesanan</p>
                                        <p class="mb-0">
                                            {{ date('d F Y', strtotime($order->created_at)) }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Tanggal Pemasangan</p>
                                        <p class="mb-0">
                                            @if ($order->installed_date != null)
                                                {{ date('d F Y', strtotime($order->installed_date)) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning btn-round">
                            <i class='fa fa-pencil-alt'></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
