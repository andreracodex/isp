<!-- Container-fluid starts-->
<div class="card-body">
    <div class="row">
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="id" class="form-control" value="{{ old('id') ?? $settings->id }}" type="text" hidden>
                <input name="name" class="form-control" value="{{ old('name') ?? $settings->name }}" type="text" placeholder="Name">
            </div>
        </div>
        <div class="col-sm-6 col-md-8">
            <div class="mb-3">
                <label class="form-label">Value</label>
                <input name="value" class="form-control" value="{{ old('value') ?? $settings->value }}" type="text" placeholder="Value">
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-end">
    <button class="btn btn-primary" type="submit">{{ $submit }}</button>
</div>
<!-- Container-fluid Ends-->
