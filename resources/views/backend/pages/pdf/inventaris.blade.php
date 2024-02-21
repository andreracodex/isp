<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container mt-5">
        <h5 class="text-center mb-3">Laporan Inventaris</h5>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Satuan Barang</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inve ?? '' as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->jenis_barang}}</td>
                    <td>{{ $data->jumlah_barang }}</td>
                    <td>{{ $data->satuan_barang }}</td>
                    <td>{{ $data->is_active }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
