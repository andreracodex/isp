<div class="card">
    <div class="card-header">
        <h5>Team Members of - {{$profile[22]->value}}</h5>
    </div>
    <div class="card-body">
        <h4>{{ $emp_active }}/{{ count($employee) }} <small>Employee Active of All Employee.</small></h4>
        <hr class="my-3">
        <div class="headerbutton">
            <div>
                <a href="{{ route('inve.create') }}" type="button"
                    class="btn btn-sm btn-outline-primary d-inline-flex"><i
                        class="ti ti-plus me-1"></i>Karyawan</a>
            </div>
            <div>
                <a href="{{ route('pdf.inventaris') }}" type="button"
                    class="btn btn-sm btn-outline-danger d-inline-flex"><i
                        class="fa fa-file-pdf">&nbsp;</i>Exspor PDF</a>
                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex"><i
                        class="fa fa-file-excel">&nbsp;</i>Exspor Excel</button>
                <button type="button" class="btn btn-sm btn-outline-warning d-inline-flex"><i
                        class="ti ti-trash me-1"></i>Hapus Filter</button>
            </div>
        </div>
    </div>
    <div class="card-body table-card">
        <div class="dt-responsive table-responsive">
            <table id="employee" class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th></th>
                        <th>Nama Karyawawn</th>
                        <th>Alamat</th>
                        <th>Nomor Telephone</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end btn-page">
        <div class="btn btn-link-danger">Cancel</div>
        <div class="btn btn-primary">Update Profile</div>
    </div>
</div>
