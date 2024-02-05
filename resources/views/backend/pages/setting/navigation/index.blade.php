@extends('layouts.backend.base')
@section('isi')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>Navigation</h3>
                {{ Breadcrumbs::render() }}
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Navigation URL</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('userrole.create') }}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input name="email" class="form-control" id="exampleFormControlInput1" type="text" placeholder="name@example.com">
                        </div>
                        <div class="mb-2">
                            <div class="col-md-6">
                                <label class="col-form-label">Pick Roles</label>
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
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Table of Role</h5>
                </div>
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

@endsection
