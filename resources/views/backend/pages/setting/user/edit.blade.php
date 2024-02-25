@extends('layouts.backend.base')

@section('title', 'User Edit')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/select2.css') }}">
@endsection

@push('script')
    <script src="{{ asset('/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select2/select2-custom.js') }}"></script>
@endpush

@section('isi')
    <!-- Container-fluid starts-->
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Assign Role</h4>
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
            <h5>Edit User Assign for "{{ $user->name }}"</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('userrole.edit', $user) }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="col-md-12 col-sm-12">
                        <label class="form-label" for="exampleFormControlInput1">Email address</label>
                        <input name="email" class="form-control" id="email" value="{{ $user->email }}" type="text"
                            placeholder="name@example.com" disabled>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label">Pick Roles</label></br>
                        <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple"
                            aria-placeholder="Select Permissions">
                            @foreach ($roles as $role)
                                <option {{ $user->roles()->find($role->id) ? 'selected' : '' }} value="{{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('permission')
                            <div class="invalid-tooltip">Please Choose Permission.</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                </div>
                <button class="btn btn-primary" type="submit">Sync</button>

            </form>
        </div>
    </div>

    <!-- Container-fluid Ends-->
@endsection
