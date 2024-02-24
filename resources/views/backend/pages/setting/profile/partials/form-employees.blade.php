<div class="card">
    <div class="card-header">
        <h5>Team Members of - {{$profile[22]->value}}</h5>
    </div>
    <div class="card-body">
        <h4>{{ $emp_active }}/{{ count($employee) }} <small>members available in your team.</small></h4>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="row">
                        <div class="col">
                            <input type="email" class="form-control">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
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
                @foreach ( $employee as $emp)
                    <tr>
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
                        <td class="text-end"><a href="#"
                                class="avtar avtar-s btn-link-secondary"><i
                                    class="ti ti-dots f-18"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end btn-page">
        <div class="btn btn-link-danger">Cancel</div>
        <div class="btn btn-primary">Update Profile</div>
    </div>
</div>
