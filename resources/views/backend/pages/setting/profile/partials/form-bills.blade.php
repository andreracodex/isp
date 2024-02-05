<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                <h4 class="fw-semibold mb-3">Informasi dan Tagihan</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label fw-semibold">
                                    Nama Bisnis*</label>
                                <input type="text" class="form-control" id="exampleInputtext" value="{{empty($user->customer->nama_customer) ? '' : $user->customer->nama_customer}}"
                                    placeholder="Nama Customer PT / Pemilik">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label fw-semibold">
                                    Alamat Bisnis*</label>
                                <input type="text" class="form-control" id="exampleInputtext"
                                    placeholder="Alamat">
                            </div>
                            <div class="">
                                <label for="exampleInputPassword1" class="form-label fw-semibold">
                                    Nama Awal*</label>
                                <input type="text" class="form-control" id="exampleInputtext"
                                    placeholder="Nama Pemilik / Username">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label fw-semibold">Customer Type*</label>
                                <input type="text" class="form-control" id="exampleInputtext"
                                    placeholder="Arts, Media &amp; Entertainment">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1"
                                    class="form-label fw-semibold">Wilayah *</label>
                                <input type="text" class="form-control" id="exampleInputtext"
                                    placeholder="Jawa Timur">
                            </div>
                            <div class="">
                                <label for="exampleInputPassword1" class="form-label fw-semibold">Nama Akhir / Gelar*
                                    </label>
                                <input type="text" class="form-control" id="exampleInputtext"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-end gap-3">
            <button class="btn btn-primary">Save</button>
            <button class="btn btn-light-danger text-danger">Cancel</button>
        </div>
    </div>
</div>
