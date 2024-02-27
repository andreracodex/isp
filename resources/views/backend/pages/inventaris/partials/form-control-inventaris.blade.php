<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="location">Lokasi Barang</label>
        <select class="form-select @error('location') is-invalid @enderror" name="location" id="location">
            <option selected disabled>Pilih Lokasi...</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" @if($location->id == $inve->location_id) @selected(true) @endif>
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
    <div class="col-md-3 mb-3">
        <label class="form-label" for="jenis_barang">Jenis Barang</label>
        <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror" name="jenis_barang"
            id="jenis_barang" value="{{ old('jenis_barang') ?? $inve->jenis_barang }}" placeholder="Jenis Barang"
            required>

        @error('jenis_barang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="jumlah_barang">Jumlah Barang</label>
        <input type="number" min="0" class="form-control @error('jumlah_barang') is-invalid @enderror"
            name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang"
            value="{{ old('jumlah_barang') ?? $inve->jumlah_barang }}" required>

        @error('jumlah_barang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="satuan_barang">Satuan Barang</label>
        <input type="text" name="satuan_barang" class="form-control @error('satuan_barang') is-invalid @enderror"
            id="satuan_barang" value="{{ old('satuan_barang') ?? $inve->satuan_barang }}" placeholder="Satuan Barang"
            aria-describedby="disc" required>

        @error('satuan_barang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
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
