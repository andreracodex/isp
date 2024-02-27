<div class="card">
    <div class="card-header">
        <h5>Permission to Team Members</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label" for="roles_email">Email address</label>
                <input name="email" class="form-control" id="roles_email" type="text" placeholder="name@example.com">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pick Roles</label></br>
                <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple"
                    aria-placeholder="Select Permissions">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </div>
    <div class="card-body table-card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>MEMBER</th>
                        <th>ROLE</th>
                        <th class="text-end">STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>
                            <div class="row">
                                <div class="col-auto pe-0">
                                    <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                                        class="wid-40 rounded-circle">
                                </div>
                                <div class="col">
                                    <h5 class="mb-0">Addie Bass</h5>
                                    <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-primary">Owner</span></td>
                        <td class="text-end"><span class="badge bg-success">Joined</span></td>
                        <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i
                                    class="ti ti-dots f-18"></i></a></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end btn-page">
        <div class="btn btn-link-danger">Cancel</div>
        <div class="btn btn-primary">Update Profile</div>
    </div>
</div>
