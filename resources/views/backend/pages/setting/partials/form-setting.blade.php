<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Web Setting</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($websetting as $websetting)
                        @php
                            if ($websetting->name == 'title') {
                                $name = 'Judul';
                            } elseif ($websetting->name == 'subtitle_text') {
                                $name = 'Subjudul';
                            } elseif ($websetting->name == 'site_currency') {
                                $name = 'Mata Uang Situs';
                            } elseif ($websetting->name == 'site_currency_symbol') {
                                $name = 'Simbol Mata Uang Situs';
                            } elseif ($websetting->name == 'company_name') {
                                $name = 'Nama Perusahaan';
                            } elseif ($websetting->name == 'company_address') {
                                $name = 'Alamat Perusahaan';
                            } elseif ($websetting->name == 'company_city') {
                                $name = 'Kota';
                            } elseif ($websetting->name == 'company_state') {
                                $name = 'Provinsi';
                            } elseif ($websetting->name == 'company_zipcode') {
                                $name = 'Kode Pos';
                            } elseif ($websetting->name == 'company_telephone') {
                                $name = 'Telefon';
                            } elseif ($websetting->name == 'company_email') {
                                $name = 'Email';
                            } else {
                                $name = $websetting->name;
                            }
                        @endphp

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">{{ $name }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $websetting->value }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="card-footer text-end btn-page">
                <div class="btn btn-outline-secondary">Cancel</div>
                <div class="btn btn-primary">Update Profile</div>
            </div> --}}
        </div>
    </div>
</div>
