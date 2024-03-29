@extends('backend.base')

@section('title', 'Employee View')

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
                        <h2 class="mb-0">Detail Karyawan</h2>
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
                        <h5>Detail Karyawan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Nama Karyawan</p>
                                        <p class="mb-0">
                                            {{ $employee->nama_karyawan }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Nomor KTP</p>
                                        <p class="mb-0">
                                            {{ $employee->nomor_ktp }}
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-1 text-muted">Gender</p>
                                        <p class="mb-0">
                                            @if ($employee->gender == '1')
                                                Laki-laki
                                            @else
                                                Perempuan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Phone</p>
                                        <p class="mb-0">
                                            {{ $employee->nomor_telephone }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Kode POS</p>
                                        <p class="mb-0">
                                            {{ $employee->kodepos_karyawan }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Email</p>
                                        <p class="mb-0">
                                            @if ($employee->user_id != null)
                                                {{ $employee->user->email }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Tipe User</p>
                                        <p class="mb-0">
                                            @if ($employee->user_id != null)
                                                {{ $employee->user->user_type }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Kota</p>
                                        <p class="mb-0">
                                            @if ($employee->kelurahan_id != null)
                                                {{ $employee->village->district->regency->name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Kecamatan</p>
                                        <p class="mb-0">
                                            @if ($employee->kelurahan_id != null)
                                                {{ $employee->village->district->name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Desa</p>
                                        <p class="mb-0">
                                            @if ($employee->kelurahan_id != null)
                                                {{ $employee->village->name }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0 pb-0">
                                <p class="mb-1 text-muted">Alamat</p>
                                <p class="mb-0">
                                    {{ $employee->alamat_karyawan }}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-round">
                            <i class='fa fa-pencil-alt'></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
