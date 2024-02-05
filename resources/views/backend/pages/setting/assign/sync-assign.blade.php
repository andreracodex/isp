@extends('layouts.backend.base')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Assign Edit</h4>
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
            <h5>Assign Edit Permission</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('assign.edit', $role) }}" method="POST" class="needs-validation" novalidate="">
                @method('PUT')
                @csrf
                <div class="mb-2">
                    <div class="col-md-4">
                        <label class="col-form-label">Choose Role</label>
                        <select name="role" id="role" class="select2 form-control" required>
                            <option disabled>Choose a Role !</option>
                            @foreach ($roles as $item)
                                <option {{ $role->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-tooltip">Please Choose a Role.</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <div class="col-md-12">
                        <label class="col-form-label">Choose Permission :</label></br>
                        <select name="permission[]" id="permission" class="select2 form-control"
                            multiple="multiple" required aria-placeholder="Select Permissions">
                            @foreach ($permission as $permi)
                                <option {{ $role->permissions()->find($permi->id) ? 'selected' : '' }}
                                    value="{{ $permi->id }}">{{ $permi->name }}</option>
                            @endforeach
                        </select>
                        @error('permision')
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
@endsection
