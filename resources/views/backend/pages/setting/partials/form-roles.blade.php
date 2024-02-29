<div class="card">
    <div class="card-header">
        <h5>Permission to Team Members</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="roles_email">Email address</label>
                <input name="email" class="form-control" id="roles_email" type="text" placeholder="name@example.com">
            </div>
            <div class="col-md-4">
                <label class="form-label">Pick Roles</label></br>
                <select name="roles[]" id="roles" style="width: 400px;" class="select2 form-control" multiple="multiple"
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
                        <th>Email Register</th>
                        <th>Roles</th>
                        <th class="text-end">State</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
