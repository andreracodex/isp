<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Web Setting</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($websetting as $websetting)
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">{{ $websetting->name }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $websetting->value }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="card-footer text-end btn-page">
                <div class="btn btn-outline-secondary">Cancel</div>
                <div class="btn btn-primary">Update Profile</div>
            </div> --}}
        </div>
    </div>
</div>
