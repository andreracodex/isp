@extends('layouts.backend.base')

@section('title', 'Permission Edit')

@section('isi')

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Permission</h4>
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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('permission.update', 'permission') }}" enctype="multipart/form-data"
                            method="POST" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            @include(
                                'layouts.backend.pages.setting.permission.partials.form-control-permission',
                                ['submit' => 'Update']
                            )
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection