<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                <button type="button" id="close" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="#">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="exit">Done</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nama Produk :</label>
            <input type="hidden" name="id" id="id" value="{{ old('id') ?? $product->id }}" hidden>
            <input type="text" name="nama_finishing_good" id="nama_finishing_good"
                value="{{ old('nama_finishing_good') ?? $product->nama_finishing_good }}"
                class="form-control @error('nama_finishing_good') is-invalid @enderror" placeholder="Nama Produk"
                required>
            @error('nama_finishing_good')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Kode Artikel :</label>
            {{-- <input type="text" name="kode_artikel" id="kode_artikel"
                value="{{ old('kode_artikel') ?? $product->kode_artikel }}"
                class="form-control @error('kode_artikel') is-invalid @enderror" placeholder="Kode Artikel" required> --}}
            <select name="article_id" id="article_id" class="form-select select2 @error('article_id') is-invalid @enderror" required>
                <option value="" disabled @if ($product->article_id == null) selected @endif>Choose Artikel !
                </option>
                @foreach ($art as $item)
                    <option value="{{ $item->id }}" {{ $product->article_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_artikel }}</option>
                @endforeach
            </select>
            @error('article_id')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Kode Finish Good :</label>
            <input type="text" name="kode_finishing_good" id="kode_finishing_good"
                value="{{ old('kode_finishing_good') ?? $product->kode_finishing_good }}"
                class="form-control @error('kode_finishing_good') is-invalid @enderror" placeholder="Kode Produk"
                required>
            <span class="validation-text text-danger" style="display: none;"></span>
            @error('kode_finishing_good')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Kategori Produk :</label>
            <select name="category" id="category" class="form-select select2 @error('category') is-invalid @enderror" required>
                <option value="" disabled @if ($product->category_id == null) selected @endif>Choose Category !
                </option>
                @foreach ($cat as $item)
                    <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_size_fg }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <label class="form-label">Harga Pokok :</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Rp</span>
            <input type="number" name="harga_pokok2" id="harga_pokok2"
                value="{{ old('harga_pokok') ?? $product->harga_pokok }}"
                class="form-control @error('harga_pokok') is-invalid @enderror"
                aria-label="Amount (to the nearest rupiah)" placeholder="Harga Pokok">

            <input type="hidden" name="harga_pokok" id="harga_pokok" value="{{ old('harga_pokok') ?? $product->harga_pokok }}" readonly>
            <span class="input-group-text">,00</span>

            @error('harga_pokok')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Harga Jual :</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Rp</span>
            <input type="number" name="harga_jual2" id="harga_jual2"
                value="{{ old('harga_jual') ?? $product->harga_jual }}"
                class="form-control @error('harga_jual') is-invalid @enderror"
                aria-label="Amount (to the nearest rupiah)" placeholder="Harga Jual">

            <input type="hidden" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') ?? $product->harga_jual }}" readonly>
            <span class="input-group-text">,00</span>
            @error('harga_jual')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Diskon :</label>
            <div class="input-group mb-3">
                <input type="number" min="0" name="diskon" id="diskon"
                    value="{{ old('diskon') ?? $product->diskon }}"
                    class="form-control @error('diskon') is-invalid @enderror" placeholder="Diskon">
                <span class="input-group-text">%</span>
            </div>
            @error('diskon')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Satuan Produk :</label>
            <select name="satuan" id="satuan" class="form-select select2 @error('satuan') is-invalid @enderror" required>
                <option selected disabled>Pilih satuan</option>
                <option value="KARUNG" @if ($product->satuan_fg == 'KARUNG') selected @endif>KARUNG</option>
                <option value="LUSIN" @if ($product->satuan_fg == 'LUSIN') selected @endif>LUSIN</option>
                <option value="PASANG" @if ($product->satuan_fg == 'PASANG') selected @endif>PASANG</option>
            </select>
            <span class="validation-text text-danger" style="display: none;"></span>
            @error('satuan')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Description :</label>
            <input type="text" name="description" id="description"
                value="{{ old('description') ?? $product->description }}"
                class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi">
            @error('description')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Tag :</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') ?? $product->tags }}"
                class="form-control @error('tags') is-invalid @enderror" placeholder="Tag">
            @error('tags')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status Product :</label>
            <select name="is_active" id="is_active" class="form-select select2 @error('is_active') is-invalid @enderror"
                required>
                <option selected disabled>Pilih Status</option>
                <option value="0" @if ($product->is_active == 0) selected @endif>Not Active</option>
                <option value="1" @if ($product->is_active == 1) selected @endif>Active</option>
            </select>
            <span class="validation-text text-danger" style="display: none;"></span>
            @error('is_active')
                <span class="validation-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Upload Foto :</label>
            <div class="input-group">
                <input type="file" name="image" id="image" class="image form-control">
                <input type="text" hidden value="{{ old('real_path') ?? $product->real_path }}" name="real_path">
                <input type="text" hidden value="{{ old('image_path') ?? $product->image_path }}"
                    name="image_path">
            </div>
        </div>
    </div>
    @if (old('real_path') ?? $product->real_path)
        <div class="col-md-6">
            <div class="mb-3">
                <a href="#">
                    <a href="{{ asset('/' . $product->real_path) }}" target="_blank">
                        <img src="{{ asset('/' . $product->real_path) }}" class='img-fluid w-10' height="20%" width="20%"
                            style="border-radius: 50%;" alt="user Photo">
                    </a>
                </a>
            </div>
        </div>
    @endif
</div>

<div class="mb-3">
</div>
<button class="btn btn-primary" type="submit">{{ $submit }}</button>
