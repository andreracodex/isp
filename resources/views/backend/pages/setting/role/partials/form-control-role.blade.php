<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label" for="validationCustom01">Role Name</label>
        <input class="form-control" name="id" id="validationCustom01" type="text" value="{{ old('name') ?? $role->id }}" hidden>
        <input class="form-control" name="name" id="validationCustom01" type="text" value="{{ old('name') ?? $role->name }}" required="">
        <div class="valid-feedback">Looks good!</div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="validationCustom02">Guard Name</label>
        <input class="form-control" name="guard_name" id="validationCustom02" placeholder='default to "web"' value="{{ old('guard_name') ?? $role->guard_name }}" type="text">
        <div class="valid-feedback">Looks good!</div>
    </div>
</div>
<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
