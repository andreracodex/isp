<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="nama">Nama Paket</label>
        <input type="text" class="form-control" name="nama_paket" id="nama_paket"
            value="{{ old('nama_paket') ?? $paket->nama_paket }}" placeholder="Nama Paket" required>

        <div class="valid-feedback"> Looks good! </div>
        @error('nama_paket')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="jenis_paket">Jenis Paket Layanan</label>
        <input type="text" class="form-control" name="jenis_paket" id="jenis_paket"
            value="{{ old('jenis_paket') ?? $paket->jenis_paket }}" placeholder="Paket Layanan" required>
        <div class="valid-feedback"> Looks good! </div>

        @error('jenis_paket')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="harga_paket">Harga Paket Internet</label>
        <input type="number" min="0" class="form-control" name="harga_paket" id="harga_paket"
            placeholder="Harga Paket" value="{{ old('harga_paket') ?? $paket->harga_paket }}" required>

        @error('harga_paket')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="disc">Diskon Paket <sup>( % )</sup></label>
        <div class="input-group">
            <span class="input-group-text" id="disc"><i class="ti ti-coin"></i></span>
            <input type="number" min="0" name="disc" class="form-control" id="disc"
                value="{{ old('disc') ?? $paket->disc }}" placeholder="Persen" aria-describedby="disc" required>

            @error('disc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success" id="customswitchlightv1-3"
                name="is_active" @if ($paket->is_active == 1) @checked(true) @else @checked(false) @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Active</label>

            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" name="check" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">Data Sudah Benar</label>
        <div class="invalid-feedback"> Harap checklist. </div>
    </div>
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
