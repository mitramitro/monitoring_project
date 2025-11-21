<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LAPORAN PERMOHONAN PTPP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <h5 style="text-align: center;">LAPORAN PERMOHONAN PTPP</h5>
    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th>No PTPP</th>
                <th>Pengusul</th>
                <th>Judul Temuan</th>
                <th>Lokasi Temuan</th>
                <th>Sumber Ketidaksesuaian</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
                <th>Target Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->number }}</td>
                <td>{{ $item->from_function }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->location->name }}</td>
                <td>{{ $item->potential_source }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->compliance_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>