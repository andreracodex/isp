@extends('layouts.backend.base')

@section('isi')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Order Detail</h4>
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('back/dist/images/breadcrumb/products.webp') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Edit Item Detail</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('order.updateOrder', $order->id) }}" id="formEdit" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- <h4>Product Order</h4> --}}
                <table class="table" id="order" width="100%">
                    <thead>
                        <tr>
                            <th width="70%">Product :
                                <button type="button" class="btn btn-success btn-sm" id="btnAdd">
                                    <h7 class="text-white"><b> + </b>Add</h7>
                                </button>
                            </th>
                            <th width="20%">Quantity</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItem as $item)
                            <tr>
                                <td>
                                    @if ($item->status == 0)
                                        <select name="product_id[]" id="product_id[]" class="selektize" required>
                                            <option value="{{ $item->product_id }}" selected>
                                                {{ $item->product->article->nama_artikel . ' - ' . $item->product->category->kode_size_fg }}
                                            </option>

                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->article->nama_artikel . ' - ' . $product->category->kode_size_fg }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" name="product_id2[]" id="product_id2[]" class="form-control"
                                            value="{{ $item->product->article->nama_artikel . ' - ' . $item->product->category->kode_size_fg }}"
                                            readonly>

                                        <input type="hidden" name="product_id[]" id="product_id[]"
                                            value="{{ $item->id }}" readonly>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status == 0)
                                        <input type="number" class="form-control" name="quantity[]" id="quantity[]"
                                            value="{{ $item->quantity }}" required>
                                    @else
                                        <input type="number" class="form-control" name="quantity[]" id="quantity[]"
                                            value="{{ $item->quantity }}" readonly>
                                    @endif

                                    <input type="hidden" class="form-control" name="item[]" id="item[]"
                                        value="{{ $item->id }}" readonly>
                                </td>

                                <td>
                                    @if ($item->status == 0)
                                        <button type="button" class="btn btn-danger hapusItem"
                                            data-id="{{ $item->id }}">x</button>
                                    @else
                                        <button type="button" class="btn btn-danger" disabled>x</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <input type="hidden" name="customer" value="{{ $order->customer_id }}" readonly> --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="submiten">Simpan</button>
                    <a href="{{ route('order.show', $order->uuid) }}" class="btn btn-dark">Kembali</a>
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
                    title: 'Konfirmasi Pesanan',
                    text: "Apakah pesanan ini sudah benar?",
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
                            'Your order has been updated.',
                            'success'
                        )
                    }
                })
            });

            $('#order').on('click', '.hapusItem', function() {
                let idItem = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: "Anda yakin ingin menghapus barang ini dari pesanan?",
                    icon: 'warning',
                    data: idItem,
                    showCancelButton: true,
                    confirmButtonColor: '#10bd9d',
                    cancelButtonColor: '#ca2062',
                    confirmButtonText: 'Ya, Dihapus !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: "{{ route('orderitem.deleteitem', ':id') }}".replace(
                                ':id', idItem),
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: idItem,
                            },
                            success: function(data) {
                                window.location.reload();
                                Swal.fire(
                                    'Berhasil!',
                                    'Item berhasil dihapus',
                                    'success'
                                )
                            },
                            error: function(error) {
                                Swal.fire('Error', 'Gagal menghapus barang', 'error');
                                // Handle error
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
