<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" for="nama">Nama Karyawan</label>
        <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan"
            value="{{ old('nama_karyawan') ?? $employee->nama_karyawan }}" placeholder="Nama Karyawan" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi nama karyawan. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_ktp">Nomor KTP <sup class="text-primary" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="ktp dapat di input opsional">*</sup></label>
        <input type="text" min="0" class="form-control" name="nomor_ktp" id="nomor_ktp"
            value="{{ old('nomor_ktp') ?? $employee->nomor_ktp }}" placeholder="Nomor KTP">
        <div class="valid-feedback"> Opsional ! </div>
        <div class="invalid-feedback"> Harap isi nomor KTP. </div>
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label" for="gender">Gender</label>
        <select class="form-select" name="gender" id="gender">
            <option value="1" @if ($employee->gender == 1) selected @endif>Laki - Laki</option>
            <option value="2" @if ($employee->gender == 2) selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nama">Email</label>
        <input type="text" class="form-control" name="email" id="email"
            value="{{ old('email') ?? $employee->email }}" placeholder="mail@example.com" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi email karyawan. </div>
    </div>
</div>

<div class="row">
    <!-- Kota input-->
    <div class="col-md-4 mb-3">
        <label class="form-label" for="kota">Kabupaten\Kota <sup class="text-danger" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="Kota dibutuhkan">*</sup></label>
        <select class="select2 form-control @error('kota') is-invalid @enderror" name="kota" id="kota" required>

            @foreach ($kotas as $kota)
                @if ($submit == 'Update')
                    <option value="{{ $kota->id }}"
                        @if ($kota->id == $employee->village->district->regency->id) @selected(true) @endif)>
                        {{ $kota->name }}
                    </option>
                @endif
                @if ($submit == 'Create')
                    <option value="{{ $kota->id }}">{{ $kota->name }}</option>
                @endif
            @endforeach

        </select>
        <div class="invalid-feedback"> Harap isi desa. </div>
    </div>

    <!-- Kecamatan input-->
    <div class="col-md-4 mb-3">
        <label class="form-label" for="kecamatan">Kecamatan <sup class="text-danger" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="Kecamatan dibutuhkan">*</sup></label>
        <select class="select2 form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan"
            required>

            @foreach ($districts as $district)
                @if ($submit == 'Update')
                    <option value="{{ $district->id }}"
                        @if ($district->id == $employee->village->district->id) @selected(true) @endif)>
                        {{ $district->name }}
                    </option>
                @endif
                @if ($submit == 'Create')
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endif
            @endforeach

        </select>
        <div class="invalid-feedback"> Harap isi kecamatan. </div>
    </div>

    <!-- Kelurahan input-->
    <div class="col-md-4 mb-3">
        <label class="form-label" for="kelurahan">Kelurahan <sup class="text-danger" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="Kelurahan dibutuhkan">*</sup></label>
        <select class="select2 form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan"
            required>
            @foreach ($villages as $village)
                @if ($submit == 'Update')
                    <option value="{{ $village->id }}"
                        @if ($village->id == $employee->village->id) @selected(true) @endif)>
                        {{ $village->name }}
                    </option>
                @endif
                @if ($submit == 'Create')
                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                @endif
            @endforeach

        </select>
        <div class="invalid-feedback"> Harap isi desa. </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="alamat_karyawan">Alamat Karyawan</label>
        <textarea class="form-control" placeholder="Alamat Karyawan" id="exampleTextarea" name="alamat_karyawan" rows="3"
            required>{{ old('alamat_karyawan') ?? $employee->alamat_karyawan }}</textarea>
        <div class="invalid-feedback"> Harap isi alamat. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="kodepos">Kode POS</label>
        <input type="number" min="0" placeholder="602xxx" class="form-control" name="kodepos_karyawan"
            id="kodepos_karyawan" placeholder="Kode POS"
            value="{{ old('kodepos_karyawan') ?? $employee->kodepos_karyawan }}" required>
        <div class="invalid-feedback"> Harap isi Kode POS. </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_telephone">Nomor HP</label>
        <div class="input-group">
            <span class="input-group-text" id="nomor_telephone"><i class="ti ti-phone-call"></i></span>
            <input type="number" min="0" name="nomor_telephone" class="form-control" id="nomor_telephone"
                value="{{ old('nomor_telephone') ?? $employee->nomor_telephone }}" placeholder="0812xxxx"
                aria-describedby="nomor_telephone" required>
            <div class="invalid-feedback"> Harap isi nomor HP. </div>
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

<button class="btn btn-primary" id="btn-success-ac @error('nomor_telephone')btn-danger-ac @enderror"
    type="submit">{{ $submit }}</button>


@push('script')
    <script type="text/javascript">
        $(function() {
            $('#kota').on('change', function() {
                let id_kota = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('region.kecamatan') }}",
                    data: {
                        id_kota: id_kota
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    success: function(msg) {
                        $('#kecamatan').html(msg);
                    },
                    error: function(data) {
                        console.log('error: ', data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#kecamatan').on('change', function() {
                let id_kecamatan = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('region.kelurahan') }}",
                    data: {
                        id_kecamatan: id_kecamatan
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    success: function(msg) {
                        $('#kelurahan').html(msg);
                    },
                    error: function(data) {
                        console.log('error: ', data);
                    }
                });
            });
        });
    </script>
@endpush
