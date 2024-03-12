<div class="row">
    <div class="col-md-9 mb-3">
        <label class="form-label" for="payment_methode_name">Nama Metode Pembayaran</label>
        <input type="text" class="form-control @error('payment_methode_name') is-invalid @enderror"
            name="payment_methode_name" id="payment_methode_name"
            value="{{ old('payment_methode_name') ?? $paymenttype->payment_methode_name }}"
            placeholder="Nama Metode Pembayaran" required>

        @error('payment_methode_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="is_active">Status Metode Pembayaran</label>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success @error('is_active') is-invalid @enderror"
                id="customswitchlightv1-3" name="is_active"
                @if ($paymenttype->is_active == 1) @checked(true) @else @checked(false) @endif>
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
