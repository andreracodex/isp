@extends('layouts.backend.base')

@section('title', 'Setting Edit')

@section('styles')
@endsection

@push('script')
    <script src="{{ asset('/assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('/assets/js/form-validation-custom.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })
    </script>
@endpush

@section('isi')

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Web Setting</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/sales.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            @can('create setweb')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5>Edit Web Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('websetting.edit', 'webset') }}" method="POST" novalidate="">
                                @csrf
                                @method('PUT')
                                @include(
                                    'layouts.backend.pages.setting.setweb.partials.form-control-settings',
                                    ['submit' => 'Update']
                                )
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection
