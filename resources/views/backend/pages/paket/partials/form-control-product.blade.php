<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nama Ukuran :</label>
            <input type="text" name="kode_size_fg" id="kode_size_fg"
                value="{{ old('kode_size_fg') ?? $category->kode_size_fg }}"
                class="form-control @error('kode_size_fg') is-invalid @enderror" placeholder="SERI" required>
            @error('kode_size_fg')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Ukuran :</label>
            <input type="text" name="size_fg" id="size_fg" value="{{ old('size_fg') ?? $category->size_fg }}"
                class="form-control @error('size_fg') is-invalid @enderror" placeholder="9 - 10.5" required>
            @error('size_fg')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Jumlah Lusin Per Karung :</label>
            <input type="text" name="lusin_per_karung" id="lusin_per_karung"
                value="{{ old('lusin_per_karung') ?? $category->lusin_per_karung }}"
                class="form-control @error('lusin_per_karung') is-invalid @enderror" placeholder="20" required>
            @error('lusin_per_karung')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Kode Jenis Plong :</label>
            <input type="text" name="kode_jenisplong" id="kode_jenisplong"
                value="{{ old('kode_jenisplong') ?? $category->kode_jenisplong }}"
                class="form-control @error('kode_jenisplong') is-invalid @enderror" placeholder="JP00...">
            @error('kode_jenisplong')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Status :</label>
            <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror"
                required>
                <option selected disabled>Pilih Status</option>
                <option value="0" @if ($category->is_active == 0) selected @endif>Not Active</option>
                <option value="1" @if ($category->is_active == 1) selected @endif>Active</option>
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
