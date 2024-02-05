@extends('layouts.backend.base')

@section('styles')
@endsection

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Sales Order</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/sales.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Create New Sales Order</h5>
        </div>
        <div class="card-body">
            <form id="form_order" action="{{ route('order.store') }}" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Customer :</label>

                            @if (Auth()->user()->user_type == 'user')
                                <input class="form-control @error('customer_id') is-invalid @enderror" type="text"
                                    name="customer_name" value="{{ Auth()->user()->customer->nama_customer }}" readonly>

                                <input class="form-control" type="hidden" name="customer_id"
                                    value="{{ Auth()->user()->customer->id }}" readonly>
                            @else
                                <select class="select2 form-control @error('customer_id') is-invalid @enderror"
                                    style="width: 100%; height: 36px" name="customer_id" id="customer_id" required>
                                    <option selected disabled>Pilih customer...</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->nama_customer . ' | ' . $customer->kota_customer }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @error('customer_id')
                                <span class="validation-text text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Order :</label>
                            <input class="form-control" type="text" value="{{ date('d m Y') }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label>Metode Pembayaran</label>

                    @foreach ($payments as $payment)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_id"
                                id="payment_id{{ $payment->id }}" value="{{ $payment->id }}" required>
                            <label class="form-check-label"
                                for="payment_id{{ $payment->id }}">{{ $payment->name }}</label>
                        </div>
                    @endforeach
                </div> --}}
                {{-- <hr /> --}}

                {{-- <h4>Product Order</h4> --}}
                <table class="table" id="order" width="100%">
                    <thead>
                        <tr>
                            <th width="70%">Pilih produk :
                                <button type="button" class="btn btn-success btn-sm" id="btnAdd">
                                    <h7 class="text-white"><b> + </b>Tambah</h7>
                                </button>
                            </th>
                            <th width="20%">Jumlah (karung)</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="product_id[]" id="product_id[]" class="selektize" required>
                                    <option></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->article->nama_artikel . ' - ' . $product->category->kode_size_fg }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" class="form-control" name="quantity[]" id="quantity[]" required>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger" disabled>x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr />
                <div class="form-group mb-3">
                    <button type="submit" id="submiten" class="btn btn-primary">Pesan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let lineNo = 2;

        $(document).ready(function() {
            $('.selektize').selectize();

            function addRow() {
                const tbody = $("#order tbody");
                const newRow = $("<tr>");
                newRow.html(
                    "<td>" +
                    "<select name='product_id[]'" +
                    "id='product_id[]' class='selectize' required>" +
                    "<option></option>" +
                    "@foreach ($products as $product)" +
                    "<option value='{{ $product->id }}'>" +
                    "{{ $product->article->nama_artikel . ' - ' . $product->category->kode_size_fg }}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "<td><input type='number' class='form-control' name='quantity[]'" +
                    "id='quantity[]' required></td>" +
                    "<td><button type='button' class='btn btn-danger' id='btnRemove'>x</button></td>"
                );
                tbody.append(newRow);

                // Initialize Selectize for the new row's dropdown
                newRow.find(".selectize").selectize();
            }

            // Add a new row when the button is clicked
            $("#btnAdd").click(addRow);

            $("#order").on('click', '#btnRemove', function() {
                $(this).closest('tr').remove();
            });

        });
        $(document).ready(function() {
            $('#submiten').on('click', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                Swal.fire({
                    title: 'Check Kembali ?',
                    text: "Data sales yang telah masuk, hanya dapat dicancel oleh Admin !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10bd9d',
                    cancelButtonColor: '#ca2062',
                    confirmButtonText: 'Ya, Simpan !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Saved!',
                            'Your file has been saved.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
