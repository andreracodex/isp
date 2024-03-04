<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label headerbutton" for="location">Lokasi Barang <sup class="mt-2"><b><a
                        href="{{ route('location.index') }}">
                        <i class="ti ti-plus me-1"></i>Tambah Lokasi</a></b></sup></label>
        <select class="form-select select2 @error('location') is-invalid @enderror" name="location" id="location">
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    @if ($location->id == $inve->location_id) @selected(true) @endif>
                    {{ $location->nama_location }}
                </option>
            @endforeach
        </select>

        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="nama_barang">Nama Barang</label>
        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang"
            id="nama_barang" value="{{ old('nama_barang') ?? $inve->nama_barang }}" placeholder="Nama Barang" required>

        @error('nama_barang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label headerbutton" for="jenis_id">Jenis Kategori<sup class="mt-2"><b><a
                        href="{{ route('invekategori.index') }}">
                        <i class="ti ti-plus me-1"></i>Tambah Kategori</a></b></sup></label>
        <select class="form-select select2 @error('jenis_id') is-invalid @enderror" name="jenis_id" id="jenis_id">
            @foreach ($kategories as $kategor)
                <option value="{{ $kategor->id }}"
                    @if ($kategor->id == $inve->jenis_id) @selected(true) @endif>
                    {{ $kategor->nama }}
                </option>
            @endforeach
        </select>

        @error('jenis_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-2 mb-3">
        <label class="form-label" for="jumlah_barang">Jumlah Barang</label>
        <input type="number" min="0" class="form-control @error('jumlah_barang') is-invalid @enderror"
            name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang"
            value="{{ old('jumlah_barang') ?? $inve->jumlah_barang }}" required>

        @error('jumlah_barang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label headerbutton" for="satuan_id">Satuan Barang<sup class="mt-2"><b><a
                        href="{{ route('invesatuan.index') }}">
                        <i class="ti ti-plus me-1"></i>Tambah Satuan</a></b></sup></label>
        <select class="form-select select2 @error('satuan_id') is-invalid @enderror" name="satuan_id" id="satuan_id">
            @foreach ($satuan as $sat)
                <option value="{{ $sat->id }}"
                    @if ($sat->id == $inve->satuan_id) @selected(true) @endif>
                    {{ $sat->nama }}
                </option>
            @endforeach
        </select>

        @error('satuan_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-2 mb-3">
        <label class="form-label" for="status_barang">Status Barang</label>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success @error('is_active') is-invalid @enderror"
                id="customswitchlightv1-3" name="is_active"
                @if ($inve->is_active == 1) @checked(true) @else @checked(false) @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Active</label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" name="check" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">Data Sudah Benar</label>

        @error('check')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
