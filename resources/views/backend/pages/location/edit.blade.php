@extends('backend.base')

@section('title', 'Location Edit')

@section('styles')
@endsection

@section('isi')
    @if ($errors->any())
        <div class="alert alert-danger dismiss-text">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Breadcrumbs --}}
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Edit Lokasi Server</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('edit location')
        <div class="card">
            <div class="card-header">
                <h5>Edit Lokasi Server</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('location.update', $location->id) }}" enctype="multipart/form-data" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    @include('backend.pages.location.partials.form-control-location', [
                        'submit' => 'Update',
                    ])
                </form>
            </div>
        </div>
    @endcan
@endsection
