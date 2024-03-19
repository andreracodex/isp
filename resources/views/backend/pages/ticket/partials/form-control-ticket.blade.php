<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Customer</label>
        <select class="form-select select2 @error('customer') is-invalid @enderror" name="customer" id="customer">
            <option selected disabled>Pilih Customer...</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">
                    {{ $customer->nama_customer }}
                </option>
            @endforeach
        </select>

        @error('customer')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label headerbutton">Ticket Opsi<sup class="mt-2"><b><a
            href="{{ route('ticketcat.create') }}">
            <i class="ti ti-plus me-1"></i>Tambah Opsi</a></b></sup></label>
        <select class="form-select select2 @error('ticket_detail') is-invalid @enderror" name="ticket_detail" id="ticket_detail">
            <option selected disabled>Ticket Opsi...</option>
            @foreach ($ticket_details as $ticket)
                <option value="{{ $ticket->id }}">
                    {{ $ticket->nama }}
                </option>
            @endforeach
        </select>

        @error('ticket_detail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="komplain_customer">Komplain Customer <sup class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="wajib di isi untuk pengecheckan dilapangan">*</sup></label>
        <textarea class="form-control" placeholder="Komplain Customer" id="exampleTextarea" name="komplain_customer" rows="3" required=""></textarea>
        <div class="invalid-feedback"> Harap isi komplain. </div>
    </div>
</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" name="check" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">Data Sudah Benar</label>
        <div class="invalid-feedback"> Harap checklist. </div>
    </div>
</div>
<button class="btn btn-primary"
    type="submit">{{ $submit }}</button>
