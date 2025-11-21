<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LAPORAN NOTA PERMINTAAN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <h5 style="text-align: center;">LAPORAN NOTA PERMINTAAN</h5>
    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th>No Nota</th>
                <th>Tanggal</th>
                <th>Fungsi Pengusul</th>
                <th>Perihal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->number }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->from }}</td>
                <td>{{ $item->regarding }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>