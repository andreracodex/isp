<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Nama User</label>
            <input class="form-control" name="id" id="id" type="text" value="{{ old('id') ?? $emp->id }}"
                hidden>
            <input class="form-control" name="name" value="{{ old('name') ?? $emp->name }}" type="text"
                placeholder="Employee Name" readonly disabled>
            <div class="invalid-tooltip" style="top: 0">Nama Karyawan required</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Email </label>
            <input class="form-control" name="email" value="{{ old('email') ?? $emp->email }}" type="email"
                placeholder="Email" required>
            <div class="invalid-tooltip" style="top: 0">Nama Trainer required</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Customer Link</label>
            <select name="customer" id="customer" class="form-control select2" required>
                @foreach ($customer as $cust)
                <option value="{{$cust->id}}">{{ $cust->nama_customer }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">User Type</label>
            <select name="user_type" id="user_type" class="form-control select2" required>
                <option value="" disabled @if ($emp->user_type == null) selected @endif>Choose Option !
                </option>
                <option value="user" @if ($emp->user_type == 'user') selected @endif>User</option>
                <option value="admin" @if ($emp->user_type == 'admin') selected @endif>Admin</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="mb-3">
            <label class="form-label">Status Aktif</label>
            <select name="is_active" id="is_active" class="form-control select2" required>
                <option value="" disabled @if ($emp->is_active == null) selected @endif>Choose Option !
                </option>
                <option value="0" @if ($emp->is_active == 0) selected @endif>Non Active</option>
                <option value="1" @if ($emp->is_active == 1) selected @endif>Active</option>
            </select>
            <div class="invalid-tooltip" style="top: 0">Status Aktif required</div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-3">{{ $submit }}
</button>
<button type="reset" class="btn btn-danger">Reset
</button>
