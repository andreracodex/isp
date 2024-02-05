<div class="row">
    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100 position-relative overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Change Profile</h5>
                <p class="card-subtitle mb-4">Change your profile picture from here</p>
                <div class="text-center">
                    @if ($user->real_path == null)
                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}" class='img-fluid rounded-circle'
                            width="120" height="120" alt="user Photo">
                    @else
                        <img src="{{ asset('/' . $user->real_path) }}" class='img-fluid rounded-circle' width="120"
                            height="120" alt="user Photo">
                    @endif

                    <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                        <input type="file" name="image" id="image" class="image form-control">
                    </div>
                    <p class="mb-0">Allowed JPG, JPEG, PNG. Max size of 1048 Kb</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100 position-relative overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Change Password</h5>
                <p class="card-subtitle mb-4">To change your password please confirm here</p>

                <div class="mb-4">
                    <label for="new_password" class="form-label fw-semibold">New
                        Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="">
                    <label for="newconfirm_password" class="form-label fw-semibold">Confirm
                        Password</label>
                    <input type="password" class="form-control" name="newconfirm_password" id="newconfirm_password">
                </div>
                <div style="margin-top: 7px;" id="checkPasswordMatch"></div>

            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card w-100 position-relative overflow-hidden mb-0">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Personal Details</h5>
                <p class="card-subtitle mb-4">To change your personal detail , edit and save from here
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Your
                                Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputtext"
                                placeholder="Name" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputtext"
                                placeholder="example@evarindo.com" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="user_name" class="form-label fw-semibold">User Name</label>
                            <input type="text" name="user_name" class="form-control" id="exampleInputtext"
                                placeholder="User Name" value="{{ $user->user_name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="no_tlp_customer" class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control numeric @error('phone') is-invalid @enderror" id="exampleInputtext"
                                placeholder="Telpon" maxlength="14"
                                value="{{ empty($user->customer->no_tlp_customer) ? $user->phone : $user->customer->no_tlp_customer }}"
                                required>
                            @error('phone')
                                <span class="validation-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @php
                            if ($user->user_type == 'user') {
                                $alamat = $user->customer->alamat_customer;
                            } else {
                                $alamat = $user->alamat;
                            }
                        @endphp

                        <div class="mb-4">
                            <label for="alamat_customer" class="form-label fw-semibold">Address</label>
                            <input type="text" name="alamat" class="form-control" id="exampleInputtext"
                                placeholder="Address" value="{{ empty($alamat) ? '-' : $alamat }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="pin" class="form-label fw-semibold">PIN</label>
                            <input type="text" name="pin" class="form-control numeric" id="exampleInputtext"
                                placeholder="PIN" maxlength="6" value="{{ empty($user->pin) ? '-' : $user->pin }}"
                                min="0">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $("#newconfirm_password").on('keyup', function() {
                var password = $("#new_password").val();
                var confirmPassword = $("#newconfirm_password").val();
                if (password != confirmPassword)
                    $("#checkPasswordMatch").html("Password does not match !").css("color", "red");
                else
                    $("#checkPasswordMatch").html("Password match !").css("color", "green");
            });

            $('.numeric').on('input', function(event) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endpush
