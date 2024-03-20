<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventaris</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <h5 class="text-center mb-3">Laporan Ticket Kategori</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-danger">
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ticketcat as $data)
                        <tr>
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->is_active }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
