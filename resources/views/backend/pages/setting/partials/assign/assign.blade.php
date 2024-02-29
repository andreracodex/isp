@extends('layouts.backend.base')

@section('title', 'Assign Permission Data')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Assign Permission</h4>
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
        <div class="card-header">
            <h5>Assign Permission</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('assign.index') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-12">
                        <label class="col-form-label">Choose Role</label>
                        <select name="role" id="role" class="select2 form-control" required>
                            <option disabled selected>Choose a Role !</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-tooltip">Please Choose a Role.</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label">Choose Permission</label></br>
                        <select name="permission[]" id="permission" class="select2 form-control" multiple="multiple"
                            required aria-placeholder="Select Permissions">
                            @foreach ($permission as $permi)
                                <option value="{{ $permi->id }}">{{ $permi->name }}</option>
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
        <div class="card-body">
            <div class="table-responsive rounded-2 mb-4">
                <table class="table border customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">#</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Role Name</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">The Permission</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Created At</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}" class="rounded-circle"
                                            width="40" height="40">
                                        <div class="ms-3">
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $role->name }}</h6>
                                            <span class="fw-normal">{{ $role->guard_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal text-primary"><a
                                            href="{{ route('assign.edit', $role) }}">{{ implode(' | ', $role->getPermissionNames()->toArray()) }}
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal">{{ $role->created_at->format('d F Y') }}</p>
                                </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3"
                                                    href="{{ route('assign.edit', $role) }}"><i
                                                        class="fs-4 ti ti-edit"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-trash"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
