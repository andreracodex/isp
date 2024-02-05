<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Payment Name</label>
        <input class="form-control" name="name" id="name" placeholder="Transfer"
            value="{{ old('name') ?? $payment->name }}" type="text" required>
        <div class="valid-feedback">Looks good!</div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Value</label>
        <input class="form-control" name="value" id="value" value="{{ old('value') ?? $payment->value }}"
            type="text">
        <div class="valid-feedback">Looks good!</div>
    </div>

    <div class="col-lg-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') ?? $payment->description }}</textarea>
        <div class="valid-feedback">Looks good!</div>
    </div>
</div>
<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
