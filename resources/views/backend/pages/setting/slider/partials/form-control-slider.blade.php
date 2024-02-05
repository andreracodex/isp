<div class="row">
    <div class="col-md-6">
        @if (old('image_path') ?? $slider->image_path)
            <div class="col-md-6">
                <div class="mb-3">
                    <a href="#">
                        <img src="{{ asset($slider->image_path) }}" class='img-fluid w-10' style="" alt="user Photo">
                    </a>
                </div>
            </div>
        @endif
        <div class="mb-3">
            <input type="hidden" name="id" id="id" value="{{ old('id') ?? $slider->id }}" hidden>
            <label class="form-label">Upload Foto : </br><small>*Must be (1400px * 500px)</small></label>
            <div class="input-group">
                <input type="file" name="image" id="image" class="image form-control">
                <input type="text" hidden value="{{ old('real_path') ?? $slider->real_path }}" name="real_path">
                <input type="text" hidden value="{{ old('image_path') ?? $slider->image_path }}" name="image_path">
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Status Slider :</label>
            <select name="is_active" id="is_active" class="form-select select2 @error('is_active') is-invalid @enderror"
                required>
                <option selected disabled>Pilih Status</option>
                <option value="0" @if ($slider->is_active == 0) selected @endif>Not Active</option>
                <option value="1" @if ($slider->is_active == 1) selected @endif>Active</option>
            </select>
            <span class="validation-text text-danger" style="display: none;"></span>
            @error('is_active')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
