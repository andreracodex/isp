@extends('backend.base')

@section('title', 'Blast Messages')

@section('styles')
@endsection

@push('script')
    <!-- Ckeditor js -->
    <script src="{{ asset('/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script>
        (function() {
            ClassicEditor.create(document.querySelector('#messages')).catch((error) => {
                console.error(error);
            });
        })();
    </script>
@endpush


@section('isi')
    {{-- Breadcrumbs --}}
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Blast Pesan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Blast Pesan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('blast.store') }}" enctype="multipart/form-data" method="POST"
                        class="needs-validation" novalidate="">
                        @csrf
                        @include('backend.pages.message.partials.form-control-message', [
                            'submit' => 'Kirim',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
