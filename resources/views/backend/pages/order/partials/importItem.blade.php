@extends('layouts.backend.base')

@section('styles')
@endsection

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Sales Order Item</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/sales.webp') }}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Import Sales Order Item</h5>
        </div>
        <div class="card-body">
            <form id="form_order" action="{{ route('orderItem.importItem') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">Upload File :</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                required>
                            <small>Hanya untuk file excel dengan format .xls dan .xlsx</small>
                            @error('file')
                                <span class="validation-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr />
                <div class="form-group mb-3">
                    <button type="submit" id="submiten" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
