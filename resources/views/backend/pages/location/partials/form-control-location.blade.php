<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nama Lokasi</label>
            <input type="text" name="nama_location" id="nama_location"
                value="{{ old('nama_location') ?? $location->nama_location }}"
                class="form-control @error('nama_location') is-invalid @enderror" placeholder="Nama Lokasi" required>

            @error('nama_location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Penanggung Jawab</label>
            <select class="form-select @error('employee') is-invalid @enderror" name="employee" id="employee">
                <option selected disabled>Pilih Karyawan...</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" @if($employee->id == $location->employee_id) @selected(true) @endif)>
                        {{ $employee->nama_karyawan }}
                    </option>
                @endforeach
            </select>

            @error('employee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Alamat Lokasi</label>
            <input type="text" name="alamat_location" id="alamat_location"
                value="{{ old('alamat_location') ?? $location->alamat_location }}"
                class="form-control @error('alamat_location') is-invalid @enderror" placeholder="Alamat Lokasi"
                required>

            @error('alamat_location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch custom-switch-v1">
                <input type="checkbox"
                    class="form-check-input input-success @error('is_active') is-invalid @enderror"
                    id="customswitchlightv1-3" name="is_active" @if ($location->is_active == 1) @checked(true) @else @checked(false) @endif>
                <label class="form-check-label" for="customswitchlightv1-3">Active</label>
            </div>
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

        @error('check')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
