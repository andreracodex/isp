@extends('backend.base')

@section('title', 'Inventory Move')

@section('styles')
@endsection

@push('script')
    <script src="{{ asset('/js/plugins/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let table = $('#inven').DataTable();

        });
    </script>
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
                        <h2 class="mb-0">Pindah Inventaris</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Pindah Inventaris</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('inve.moveInve') }}" enctype="multipart/form-data" method="POST"
                        class="needs-validation" novalidate="">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label headerbutton" for="location">Tujuan Lokasi</label>
                            <select class="form-select select2 @error('location') is-invalid @enderror" name="location"
                                id="location" required>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->nama_location . ' - ' . $location->alamat_location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label headerbutton" for="inve">Pilih Inventaris</label>
                            <table id="inven" class="table compact table-striped table-hover table-bordered wrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No.</th>
                                        <th style="width: 10px;">#</th>
                                        <th>Lokasi Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventaris as $inve)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <input type="checkbox" name="inve[]" id="inve[]"
                                                    value="{{ $inve->id }}">
                                            </td>
                                            <td>{{ $inve->location->nama_location }}</td>
                                            <td>{{ $inve->nama_barang }}</td>
                                            <td>{{ $inve->kategori->nama }}</td>
                                            <td>{{ $inve->satuan->nama }}</td>
                                            <td>{{ number_format($inve->jumlah_barang, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
