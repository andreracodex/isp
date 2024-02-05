<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label" for="validationCustom01">Permission Name</label>
        <input class="form-control" name="id" id="validationCustom01" type="text" value="{{ old('name') ?? $permis->id }}" hidden>
        <input class="form-control" name="name" id="validationCustom01" value="{{ old('name') ?? $permis->name }}" type="text" required="">
        <div class="valid-feedback">Looks good!</div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="validationCustom02">Guard Name</label>
        <input class="form-control" name="guard_name" id="validationCustom02" value="{{ old('guard_name') ?? $permis->guard_name }}" placeholder='default to "web"' type="text">
        <div class="valid-feedback">Looks good!</div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="validationCustom02">Guard Group</label>
        <input class="form-control" name="guard_group" id="validationCustom02" value="{{ old('guard_group') ?? $permis->guard_group }}" type="text">
        <div class="valid-feedback">Looks good!</div>
    </div>
</div>
<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
