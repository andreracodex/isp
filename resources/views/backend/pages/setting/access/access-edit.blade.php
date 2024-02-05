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
                    <h4 class="fw-semibold mb-8">User Access</h4>
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
            <h5>User Access Control</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('useraccess.edit', 'slug') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                @include('layouts.backend.pages.setting.access.partials.form-control-access', [
                    'submit' => 'Save',
                ])
            </form>
        </div>
    </div>
@endsection
