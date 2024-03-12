<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="kode_bank">Kode Bank</label>
        <input type="text" class="form-control @error('kode_bank') is-invalid @enderror" name="kode_bank" id="kode_bank"
            value="{{ old('kode_bank') ?? $bank->kode_bank }}" placeholder="Kode Bank" required>

        @error('kode_bank')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="nama_bank">Nama Bank</label>
        <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank"
            id="nama_bank" value="{{ old('nama_bank') ?? $bank->nama_bank }}" placeholder="Nama Bank" required>

        @error('nama_bank')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-5 mb-3">
        <label class="form-label" for="nama_akun">Nama Akun</label>
        <input type="text" class="form-control @error('nama_akun') is-invalid @enderror" name="nama_akun"
            id="nama_akun" value="{{ old('nama_akun') ?? $bank->nama_akun }}" placeholder="Nama Akun" required>

        @error('nama_akun')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-3">
        <label class="form-label" for="nomor_akun_rekening">Nomor Akun Rekening</label>
        <input type="text" class="form-control @error('nomor_akun_rekening') is-invalid @enderror"
            name="nomor_akun_rekening" id="nomor_akun_rekening"
            value="{{ old('nomor_akun_rekening') ?? $bank->nomor_akun_rekening }}" placeholder="Nomor Rekening"
            required>

        @error('nomor_akun_rekening')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-5 mb-3">
        <label class="form-label" for="payment">Payment</label>
        <select class="form-select select2 @error('payment') is-invalid @enderror" name="payment" id="payment"
            required>
            @foreach ($payments as $payment)
                <option value="{{ $payment->id }}"
                    @if ($payment->id == $bank->payment_id) @selected(true) @endif>
                    {{ $payment->payment_methode_name }}
                </option>
            @endforeach
        </select>

        @error('payment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-2 mb-3">
        <label class="form-label" for="status_kategori">Status Kategori</label>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success @error('is_active') is-invalid @enderror"
                id="customswitchlightv1-3" name="is_active"
                @if ($bank->is_active == 1) @checked(true) @else @checked(false) @endif>
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
