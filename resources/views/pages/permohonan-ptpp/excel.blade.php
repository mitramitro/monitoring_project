<table>
    <thead>
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