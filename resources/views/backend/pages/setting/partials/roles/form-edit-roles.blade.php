@extends('backend.base')

@section('title', 'My Profile')

@section('isi')
    <div class="card">
        <div class="card-header">
            <h5>User Role Permission</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('settings.roleupdate', $setting) }}" method="POST" class="needs-validation"
                    novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <div class="col-md-12 col-sm-12">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input name="email" class="form-control" id="email" value="{{ $users[0]->email }}"
                                type="text" placeholder="name@example.com" disabled>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-12 col-sm-12">
                            <label class="col-form-label">Pick Roles</label><br>
                            <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple"
                                aria-placeholder="Select Permissions">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"  @if($users[0]->roles()->find($role->id)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-tooltip">Please Choose Role.</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                    </div>
                    <button class="btn btn-primary" type="submit">Sync</button>

                </form>
            </div>
        </div>
    </div>
@endsection
