<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nama Customer :</label>
            <input type="text" name="nama_customer" id="nama_customer"
                value="{{ old('nama_customer') ?? $customer->nama_customer }}"
                class="form-control @error('nama_customer') is-invalid @enderror" placeholder="PT. Jaya Sentosa" required>
            @error('nama_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Alamat Customer :</label>
            <input type="text" name="alamat_customer" id="alamat_customer"
                value="{{ old('alamat_customer') ?? $customer->alamat_customer }}"
                class="form-control @error('alamat_customer') is-invalid @enderror" placeholder="Jalan Sepanjang no. 02"
                required>
            @error('alamat_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">Kota :</label>
            <input type="text" name="kota_customer" id="kota_customer"
                value="{{ old('kota_customer') ?? $customer->kota_customer }}"
                class="form-control @error('kota_customer') is-invalid @enderror" placeholder="Surabaya" required>
            @error('kota_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">Kode Pos :</label>
            <input type="text" name="kode_pos_customer" id="kode_pos_customer"
                value="{{ old('kode_pos_customer') ?? $customer->kode_pos_customer }}"
                class="form-control @error('kode_pos_customer') is-invalid @enderror" placeholder="67..">
            @error('kode_pos_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">No. Telp :</label>
            <input type="text" name="no_tlp_customer" id="no_tlp_customer"
                value="{{ old('no_tlp_customer') ?? $customer->no_tlp_customer }}"
                class="form-control @error('no_tlp_customer') is-invalid @enderror" placeholder="62343..." required>
            @error('no_tlp_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">No. Fax :</label>
            <input type="text" name="no_fax_customer" id="no_fax_customer"
                value="{{ old('no_fax_customer') ?? $customer->no_fax_customer }}"
                class="form-control @error('no_fax_customer') is-invalid @enderror" placeholder="62343...">
            @error('no_fax_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Jenis Customer :</label>
            <input type="text" name="jenis_customer" id="jenis_customer"
                value="{{ old('jenis_customer') ?? $customer->jenis_customer }}"
                class="form-control @error('jenis_customer') is-invalid @enderror" placeholder="Agen">
            @error('jenis_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Subsidi Option :</label>
            <input type="text" name="subsisdi_option" id="subsisdi_option"
                value="{{ old('subsisdi_option') ?? $customer->subsisdi_option }}"
                class="form-control @error('subsisdi_option') is-invalid @enderror" placeholder="Subsidi...">
            @error('subsisdi_option')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Diskon Customer :</label>
            <input type="text" name="diskon_customer" id="diskon_customer"
                value="{{ old('diskon_customer') ?? $customer->diskon_customer }}"
                class="form-control @error('diskon_customer') is-invalid @enderror" placeholder="0">
            @error('diskon_customer')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Jatuh Tempo :</label>
            <input type="text" name="jatuh_tempo" id="jatuh_tempo"
                value="{{ old('jatuh_tempo') ?? $customer->jatuh_tempo }}"
                class="form-control @error('jatuh_tempo') is-invalid @enderror" placeholder="Jatuh Tempo">
            @error('jatuh_tempo')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Biaya Rute :</label>
            <input type="text" name="biaya_rute" id="biaya_rute"
                value="{{ old('biaya_rute') ?? $customer->biaya_rute }}"
                class="form-control @error('biaya_rute') is-invalid @enderror" placeholder="Biaya Rute">
            @error('biaya_rute')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Status :</label>
            <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror"
                required>
                <option selected disabled>Pilih Status</option>
                <option value="0" @if ($customer->is_active == 0) selected @endif>Not Active</option>
                <option value="1" @if ($customer->is_active == 1) selected @endif>Active</option>
            </select>
            <span class="validation-text text-danger" style="display: none;"></span>
            @error('is_active')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
