<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Informasi Personal</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 text-center mb-3">
                        <div class="user-upload wid-75">
                            <img src="{{ asset(Auth::user()->real_path) }}" alt="img"
                                class="img-fluid">
                            <label for="uplfile" class="img-avtar-upload">
                                <i class="ti ti-camera f-24 mb-1"></i>
                                <span>Upload</span>
                            </label>
                            <input type="file" id="uplfile" class="d-none">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="@if(Auth::user()->customer != null) {{ Auth::user()->customer->nama_customer }}@else-@endif">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">User Name</label>
                            <input type="text" name="user_name" class="form-control" value="@if(Auth::user()->customer != null) {{ Auth::user()->user_name }}@else-@endif">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="@if(Auth::user()->customer != null) {{ Auth::user()->email }}@else-@endif">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan_customer" class="form-control" value="@if(Auth::user()->customer != null) {{ Auth::user()->customer->kecamatan_customer }}@else-@endif">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Desa</label>
                            <input type="text" name="desa_customer" class="form-control" value="@if(Auth::user()->customer != null) {{ Auth::user()->customer->desa_customer }}@else-@endif">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Kode POS</label>
                            <input type="number" name="kodepos_customer" class="form-control" value="@if(Auth::user()->customer != null){{Auth::user()->customer->kodepos_customer}}@else{{0}}@endif">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Nomor Telephone</label>
                            <input type="number" name="nomor_telephone" class="form-control" value="@if(Auth::user()->customer != null){{Auth::user()->customer->nomor_telephone}}@else{{0}}@endif">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Alamat Customer</label>
                            <textarea class="form-control">@if(Auth::user()->customer != null) {{ Auth::user()->customer->alamat_customer }}@else-@endif</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end btn-page">
                <div class="btn btn-outline-secondary">Cancel</div>
                <div class="btn btn-primary">Update Profile</div>
            </div>
        </div>
    </div>
</div>
