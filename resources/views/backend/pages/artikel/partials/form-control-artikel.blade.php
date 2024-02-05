<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Kode Artikel :</label>
            <input type="text" name="kode_artikel" id="kode_artikel"
                value="{{ old('kode_artikel') ?? $article->kode_artikel }}"
                class="form-control @error('kode_artikel') is-invalid @enderror" placeholder="Kode Artikel" required>
            @error('kode_artikel')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Kode Spon Plong :</label>
            <input type="text" name="kode_spon_plong" id="kode_spon_plong"
                value="{{ old('kode_spon_plong') ?? $article->kode_spon_plong }}"
                class="form-control @error('kode_spon_plong') is-invalid @enderror" placeholder="Kode Spon Plong"
                required>
            @error('kode_spon_plong')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nama Artikel :</label>
            <input type="hidden" name="id" id="id" value="{{ old('id') ?? $article->id }}" hidden>
            <input type="text" name="nama_artikel" id="nama_artikel"
                value="{{ old('nama_artikel') ?? $article->nama_artikel }}"
                class="form-control @error('nama_artikel') is-invalid @enderror" placeholder="Nama Artikel" required>
            @error('nama_artikel')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status :</label>
            <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror"
                required>
                <option selected disabled>Pilih Status</option>
                <option value="0" @if ($article->is_active == 0) selected @endif>Not Active</option>
                <option value="1" @if ($article->is_active == 1) selected @endif>Active</option>
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
