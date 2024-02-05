@extends('layouts.backend.base')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <!-- Container-fluid starts-->
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Assign User</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/permission.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h5>Assign User Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('userrole.create') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="mb-3">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="exampleFormControlInput1">Email address</label>
                        <input name="email" class="form-control" id="exampleFormControlInput1" type="text"
                            placeholder="name@example.com">
                    </div>
                </div>
                <div class="mb-2">
                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label">Pick Roles</label></br>
                        <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple"
                            aria-placeholder="Select Permissions">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('permission')
                            <div class="invalid-tooltip">Please Choose Permission.</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                </div>
                <button class="btn btn-primary" type="submit">Assign</button>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Assign of Role</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Roles Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('userrole.edit', $user) }}">{{ implode(' | ', $user->getRoleNames()->toArray()) }}</a></td>
                            <td><a href="{{ route('userrole.edit', $user) }}" class="btn btn-primary btn-sm">Sync</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Container-fluid Ends-->
@endsection
