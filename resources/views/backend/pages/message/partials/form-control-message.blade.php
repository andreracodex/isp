<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Customer</label>
        <select class="form-select select2 @error('customer') is-invalid @enderror" multiple="multiple" name="customer[]" id="customer">
            <option disabled> -- Pilih Customer --</option>
            <option value="0">All Customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">
                    {{ $customer->nama_customer }}
                </option>
            @endforeach
        </select>

        @error('customer')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label" for="komplain_customer">Isi Pesan WA Blast <sup class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="wajib di isi untuk pesan">*</sup></label>
        <p>
            <span class="badge bg-secondary">%customer%</span>
            <span class="badge bg-secondary">%bulantahun%</span>
        </p>
        <textarea class="form-control" placeholder="Blast Messages" id="messages" name="messages" required=""></textarea>
        <div class="invalid-feedback"> Harap isi komplain. </div>
    </div>
</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" name="check" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">Data Sudah Benar</label>
        <div class="invalid-feedback"> Harap checklist. </div>
    </div>
</div>
<button class="btn btn-primary"
    type="submit">{{ $submit }}</button>
