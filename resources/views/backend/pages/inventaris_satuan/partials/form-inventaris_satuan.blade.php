<div class="row">
    <div class="col-md-9 mb-3">
        <label class="form-label" for="nama">Nama Satuan</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
            value="{{ old('nama') ?? $invesatuan->nama }}" placeholder="Nama Satuan" required>

        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="status_kategori">Status Satuan</label>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success @error('is_active') is-invalid @enderror"
                id="customswitchlightv1-3" name="is_active"
                @if ($invesatuan->is_active == 1) @checked(true) @else @checked(false) @endif>
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
