<table>
    <thead>
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