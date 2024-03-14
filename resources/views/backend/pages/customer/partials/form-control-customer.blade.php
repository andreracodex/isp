<div class="row">
    <div class="col-md-3 mb-3">
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-success" id="customswitchlightv1-3" name="is_new"
                @if ($customer->is_new == 1) @checked(true) @else @checked(false) @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Pelanggan Baru <sup class="text-danger"
                    data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="status pelanggan baru, jika non aktif pelanggan lama">*</sup></label>
        </div>
        <div class="form-check form-switch custom-switch-v1 mt-3">
            <input type="checkbox" class="form-check-input input-success" id="customswitchlightv1-3" name="is_active"
                @if ($customer->is_active == 1) @checked(true) @else @checked(false) @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Pelanggan Active <sup class="text-danger"
                    data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="status pelanggan harap aktif, jika maasih berlangganan">*</sup></label>
        </div>
        <div class="form-check form-switch custom-switch-v1 mt-3">
            <input type="checkbox" class="form-check-input input-success" id="customswitchlightv1-3" name="is_installed"
                @if ($order->installed_status == 1) @checked(true) @else @checked(false) @endif>
            <label class="form-check-label" for="customswitchlightv1-3">Pelanggan Terpasang <sup class="text-danger"
                    data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="status pelanggan telah terpasang, jika non aktif belum terpasang">*</sup></label>
        </div>
    </div>

    <div class="col-md-9 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                </path>
            </symbol>
        </svg>
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                <use xlink:href="#exclamation-triangle-fill"></use>
            </svg>
            <div> Ini adalah pilihan untuk membuat tagihan bulan pertama untuk pelanggan baru, pemasangan baru, dan
                status pelanggan aktif. Harap perhatikan dengan cara arahkan kursor ke tanda * (Untuk penjelasan lebih
                lanjut) </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="nama">Nama Customer <sup class="text-danger" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="Nama Customer dibutuhkan">*</sup></label>
        <input type="text" type="hidden" hidden name="order_id" value="{{ $order->id }}">
        <input type="text" class="form-control" name="nama_customer" id="nama_customer"
            value="{{ old('nama_customer') ?? $customer->nama_customer }}" placeholder="Nama Customer" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi nama customer. </div>
    </div>
    @if ($submit != 'Create')
        <div class="col-md-3 mb-3">
            <label class="form-label" for="nomor_layanan">Nomor Layanan</label>
            <input type="text" min="0" class="form-control" name="nomor_layanan" id="nomor_layanan"
                value="{{ old('nomor_layanan') ?? $customer->nomor_layanan }}" placeholder="Nomor Layanan">
            <div class="valid-feedback"> Opsional ! </div>
            <div class="invalid-feedback"> Harap isi nomor layanan. </div>
        </div>
    @endif

    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_ktp">Nomor KTP <sup class="text-primary" data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-original-title="ktp dapat di input opsional">*</sup></label>
        <input type="number" min="0" class="form-control" name="nomor_ktp" id="nomor_ktp"
            value="{{ old('nomor_ktp') ?? $customer->nomor_ktp }}" placeholder="Nomor KTP">
        <div class="valid-feedback"> Opsional ! </div>
        <div class="invalid-feedback"> Harap isi nomor KTP. </div>
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
        <label class="form-label" for="alamat_customer">Alamat Customer <sup class="text-danger" data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-original-title="alamat wajib di isi untuk lokasi pemasangan">*</sup></label>
        <textarea class="form-control" placeholder="Alamat Customer" id="exampleTextarea" name="alamat_customer"
            rows="3" required>{{ old('alamat_customer') ?? $customer->alamat_customer }}</textarea>
        <div class="invalid-feedback"> Harap isi alamat. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="kodepos">Kode POS <sup class="text-primary" data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-original-title="kodepos dapat di input opsional">*</sup></label>
        <input type="number" min="0" placeholder="602xxx" class="form-control" name="kodepos_customer"
            id="kodepos_customer" placeholder="Kode POS"
            value="{{ old('kodepos_customer') ?? $customer->kodepos_customer }}" required>
        <div class="invalid-feedback"> Harap isi Kode POS. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="nomor_telephone">Nomor HP <sup class="text-danger" data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-original-title="nomor hp wajib di isi untuk wa gateway">*</sup></label>
        <div class="input-group">
            <span class="input-group-text" id="nomor_telephone"><i class="ti ti-phone-call"></i></span>
            <input type="number" min="0" name="nomor_telephone" class="form-control" id="nomor_telephone"
                value="{{ old('nomor_telephone') ?? preg_replace('/[^0-9]/', '', $customer->nomor_telephone) }}"
                placeholder="0812xxxx" aria-describedby="nomor_telephone" required>
            <div class="invalid-feedback"> Harap isi nomor HP. </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="nama">Email Customer <sup class="text-danger" data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-original-title="wajib di isi untuk pemberitahuan melalui email">*</sup></label>
        <input type="email" class="form-control" name="email" id="email"
            value="{{ old('email') ?? $customer->email }}@if ($submit != 'Create') {{ $customer->user->email }}@else{{ $customer->email }} @endif"
            placeholder="mail@example" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi email customer. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label headerbutton">Lokasi Server <sup class="mt-2"><b><a
                        href="{{ route('location.index') }}">
                        <i class="ti ti-plus me-1"></i>Tambah Lokasi</a></b></sup></label>
        <select class="form-select @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" required>
            @foreach ($lokasi as $lokasi_detail)
                <option value="{{ $lokasi_detail->id }}">
                    {{ $lokasi_detail->nama_location }}
                </option>
            @endforeach
        </select>

        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label headerbutton">Paket Internet <sup class="mt-2"><b><a
                        href="{{ route('paket.index') }}">
                        <i class="ti ti-plus me-1"></i>Tambah Paket</a></b></sup></label>
        <select class="form-select @error('paket_internet') is-invalid @enderror" name="paket_internet"
            id="paket_internet" required>
            @foreach ($paket as $paket_detail)
                <option value="{{ $paket_detail->id }}">
                    {{ $paket_detail->nama_paket }} - {{ $paket_detail->jenis_paket }}
                </option>
            @endforeach
        </select>

        @error('paket')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="biaya_pasang">Biaya Pemasangan <sup class="text-primary"
                data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="biaya pasang dibebankan ketika ada tambahan biaya">*</sup></label>
        <input type="number" min="0" class="form-control" name="biaya_pasang" id="biaya_pasang"
            value="{{ old('biaya_pasang') ?? $order->biaya_pasang }}" placeholder="Biaya Pasang">
        <div class="valid-feedback"> Opsional </div>
        <div class="invalid-feedback"> Harap isi biaya pasang layanan. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="biaya_pasang">Foto <sup class="text-primary" data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-original-title="foto lokasi pemasangan aksess internet">*</sup></label>
        <input type="file" name="file_upload" class="form-control" aria-label="file example">
        <div class="valid-feedback"> Opsional </div>
        <div class="invalid-feedback"> Harap isi foto lokasi pasang layanan. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="installed_date">Tanggal Pemasangan <sup class="text-danger"
                data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="tanggal pemasangan layanan">*</sup></label>
        <input class="form-control" type="date" name="installed_date"
            value="{{ old('installed_date') ?? \Carbon\Carbon::parse($order->installed_date)->format('Y-m-d') }}"
            id="demo-date-only" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi tanggal pemasangan. </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="due_date">Tanggal Jatuh Tempo <sup class="text-danger"
                data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="tanggal jatuh tempo tagihan layanan">*</sup></label>
        <input class="form-control" type="date" name="due_date"
            value="{{ old('due_date') ?? \Carbon\Carbon::parse($order->due_date)->format('Y-m-d') }}"
            id="demo-date-only" required>
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> Harap isi tanggal jatuh tempo. </div>
    </div>
</div>

<div class="row">
    <!-- Kota input-->
    <div class="col-md-4 mb-3">
        <label class="form-label" for="kota">Kabupaten\Kota <sup class="text-danger" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-original-title="Kota dibutuhkan">*</sup></label>
        <select class="select2 form-control @error('kota') is-invalid @enderror" name="kota" id="kota"
            required>

            @foreach ($kotas as $kota)
                @if ($submit == 'Update')
                    <option value="{{ $kota->id }}"
                        @if ($kota->id == $customer->village->district->regency->id) @selected(true) @endif)>
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
        <select class="select2 form-control @error('kecamatan') is-invalid @enderror" name="kecamatan"
            id="kecamatan" required>

            @foreach ($districts as $district)
                @if ($submit == 'Update')
                    <option value="{{ $district->id }}"
                        @if ($district->id == $customer->village->district->id) @selected(true) @endif)>
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
        <select class="select2 form-control @error('kelurahan') is-invalid @enderror" name="kelurahan"
            id="kelurahan" required>
            @foreach ($villages as $village)
                @if ($submit == 'Update')
                    <option value="{{ $village->id }}"
                        @if ($village->id == $customer->village->id) @selected(true) @endif)>
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

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" name="check" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">Data Sudah Benar</label>
        <div class="invalid-feedback"> Harap checklist. </div>
    </div>
    <div class="mt-2">
        <sup class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="tanggal jatuh tempo tagihan layanan">(*) Dibutuhkan</sup>
        <sup class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="tanggal jatuh tempo tagihan layanan">(*) Opsional</sup>
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
