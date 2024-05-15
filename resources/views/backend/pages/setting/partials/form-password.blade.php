@push('script')
@endpush
<div class="card">
    <div class="card-header">
        <h5>Change Password</h5>
    </div>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input name="password" id="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input name="confirm_password" id="confirm_password" type="password" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5>New password must contain:</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 8
                            characters</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                            lower letter (a-z)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                            uppercase letter(A-Z)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                            number (0-9)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                            special characters</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <div class="card-footer text-end btn-page">
        <div class="btn btn-outline-secondary">Cancel</div>
        <button type="submit" class="btn btn-primary">Update Password</button>
    </div>
</div>
