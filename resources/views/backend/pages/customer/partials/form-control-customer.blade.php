<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="nama">Nama Customer</label>
        <input type="text" class="form-control" name="nama_customer" id="nama_customer"
            value="{{ old('nama_customer') ?? $customer->nama_customer }}" placeholder="Nama Customer" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi nama customer. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_layanan">Nomor Layanan</label>
        <input type="number" min="0" class="form-control" name="nomor_layanan" id="nomor_layanan" value="{{ old('nomor_layanan') ?? $customer->nomor_layanan }}"
            placeholder="Nomor Layanan" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi nomor layanan. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="gender">Gender</label>
        <select class="form-select" name="gender" id="gender">
            <option value="1" @if ($customer->gender == 1) selected @endif>Laki - Laki</option>
            <option value="2" @if ($customer->gender == 2) selected @endif>Perempuan</option>
        </select>
    </div>

</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="alamat_customer">Alamat Customer</label>
        <textarea class="form-control" id="exampleTextarea" name="alamat_customer" rows="3" required>{{ old('alamat_customer') ?? $customer->alamat_customer }}</textarea>
        <div class="invalid-feedback"> Harap isi alamat. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="kecamatan">Kecamatan</label>
        <input type="text" class="form-control" name="kecamatan_customer" id="kecamatan_customer" placeholder="Kecamatan" value="{{ old('kecamatan_customer') ?? $customer->kecamatan_customer }}" required>
        <div class="invalid-feedback"> Harap isi kecamatan. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="desa">Desa</label>
        <input type="text" class="form-control" name="desa_customer" id="desa_customer" placeholder="Desa" value="{{ old('desa_customer') ?? $customer->desa_customer }}" required>
        <div class="invalid-feedback"> Harap isi desa. </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="kodepos">Kode POS</label>
        <input type="number" min="0" placeholder="602xxx" class="form-control" name="kodepos_customer" id="kodepos_customer" placeholder="Kode POS" value="{{ old('kodepos_customer') ?? $customer->kodepos_customer }}" required>
        <div class="invalid-feedback"> Harap isi desa. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_telephone">Nomor HP</label>
        <div class="input-group">
            <span class="input-group-text" id="nomor_telephone"><i class="ti ti-phone-call"></i></span>
            <input type="number" min="0" name="nomor_telephone" class="form-control" id="nomor_telephone" value="{{ old('nomor_telephone') ?? $customer->nomor_telephone }}"
                placeholder="0812xxxx" aria-describedby="nomor_telephone" required>
            <div class="invalid-feedback"> Harap isi nomor HP. </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success" id="customswitchlightv1-3"
                name="is_active" @if ($customer->is_active == 1 )
                    @checked(true) @else @checked(false)
                @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Active</label>
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
<button class="btn btn-primary" id="btn-success-ac @error('nomor_telephone')btn-danger-ac @enderror" type="submit">{{ $submit }}</button>
