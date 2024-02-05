<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <h4 class="fw-semibold mb-3">Two-factor Authentication</h4>
                <div class="d-flex align-items-center justify-content-between pb-7">
                    <p class="mb-0">Gunakan two factor code agar lebih aman menggunakan website ini.</p>
                    <button class="btn btn-primary">Enable</button>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3 border-top">
                    <div>
                        <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                        <p class="mb-0">Google auth app</p>
                    </div>
                    <button class="btn btn-light-primary text-primary">Setup</button>
                </div>
                {{-- <div class="d-flex align-items-center justify-content-between py-3 border-top">
                    <div>
                        <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                        <p class="mb-0">E-mail to send verification link</p>
                    </div>
                    <button class="btn btn-light-primary text-primary">Setup</button>
                </div> --}}
                <div class="d-flex align-items-center justify-content-between py-3 border-top">
                    <div>
                        <h5 class="fs-4 fw-semibold mb-0">Phone Number for Contact & Recovery</h5>
                        <p class="mb-0">Your phone number or something</p>
                    </div>
                    @if (empty($user->customer->no_tlp_customer))
                        <button class="btn btn-light-primary text-primary">Linked</button>
                    @else
                        <button class="btn btn-success text-white">Already Linked</button>
                    @endif
                </div>
                <div>
                    @if (!empty($user->customer->no_tlp_customer))
                    <p class="mb-0">Number Registered</p>
                    <input type="text" name="no_tlp_customer" class="form-control" id="exampleInputtext"
                    value="{{ empty($user->customer->no_tlp_customer) ? $user->phone : $user->customer->no_tlp_customer }}"
                    placeholder="Nomor Phone" readonly>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                    <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
                </div>
                <h5 class="fs-5 fw-semibold mb-0">Devices</h5>
                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                <button class="btn btn-primary mb-4">Sign out from all devices</button>
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
                        <div>
                            <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                            <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                        </div>
                    </div>
                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                        href="javascript:void(0)">
                        <i class="ti ti-dots-vertical"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-device-laptop text-dark d-block fs-7" width="26" height="26"></i>
                        <div>
                            <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                            <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                        </div>
                    </div>
                    <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                        href="javascript:void(0)">
                        <i class="ti ti-dots-vertical"></i>
                    </a>
                </div>
                <button class="btn btn-light-primary text-primary w-100 py-1">Need Help ?</button>
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
