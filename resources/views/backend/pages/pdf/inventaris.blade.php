<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventaris</title>
    <link href="{{ asset('css/plugins/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <h5 class="text-center mb-3">Laporan Inventaris Barang</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-danger">
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Satuan Barang</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inve as $data)
                        <tr>
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->jenis_barang }}</td>
                            <td>{{ $data->jumlah_barang }}</td>
                            <td>{{ $data->satuan_barang }}</td>
                            <td>{{ $data->is_active }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
