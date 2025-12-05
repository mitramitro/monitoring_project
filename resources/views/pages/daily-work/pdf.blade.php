<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Work PDF</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header-wrapper {
            width: 100%;
            margin-bottom: 15px;
        }

        .logo {
            width: 100px;
            float: right;
        }

        .title-block {
            text-align: center;
            margin-top: 10px;
        }

        .title-block h1 {
            font-size: 18px;
            margin: 0;
        }

        .title-block h3 {
            font-size: 14px;
            margin: 0;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;        /* horizontal center */
            vertical-align: middle;    /* vertical center */
        }

        table th {
            background: #eaeaea;
        }

        .absen-title {
            margin-top: 25px;
            font-size: 14px;
            font-weight: bold;
        }

        .off-red {
            color: #c70000;
            font-weight: bold;
        }
    </style>

</head>
<body>

    {{-- HEADER --}}
    <div class="header-wrapper">
        <img src="{{ public_path('images/logo.png') }}" class="logo">
        <div class="title-block">
            <h1>Monitoring Project - Integrated Terminal Balongan</h1>
            <h3>{{ \Carbon\Carbon::parse($dailyWork->date)->translatedFormat('l, d F Y') }}</h3>
        </div>
    </div>

    {{-- ======================== --}}
    {{--       TABEL UTAMA        --}}
    {{-- ======================== --}}
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pekerjaan</th>
                <th>Anggaran</th>
                <th>Pelaksana</th>
                <th>Jumlah Pekerja Masuk</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Rencana Lembur</th>
            </tr>
        </thead>

        <tbody>
            @forelse($items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->contract->job_title }}</td>
                    <td >{{ $item->contract->budget }}</td>
                    <td>{{ $item->contract->company->name }}</td>

                    <td class="{{ $item->is_absen ? 'off-red' : '' }}">
                        {{ $item->is_absen ? 'OFF' : ($item->total_workers ?? '0') }}
                    </td>

                    <td class="{{ $item->is_absen ? 'off-red' : '' }}">
                        {{ $item->is_absen ? 'OFF' : ($item->time_in ?? '-') }}
                    </td>

                    <td class="{{ $item->is_absen ? 'off-red' : '' }}">
                        {{ $item->is_absen ? 'OFF' : ($item->time_out ?? '-') }}
                    </td>

                    <td class="{{ $item->is_absen ? 'off-red' : '' }}">
                        {{ $item->is_absen ? 'OFF' : ($item->overtime_until_plan ?? '-') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:15px;">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ======================== --}}
    {{--       ABSEN REASON       --}}
    {{-- ======================== --}}
    <div class="absen-title">KETERANGAN:</div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pekerjaan</th>
                <th>Perusahaan</th>
                <th>Alasan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($listAbsen as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->contract->job_title }}</td>
                    <td>{{ $item->contract->company->name }}</td>
                    <td>{{ $item->absen_reason }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:10px;">
                        Tidak ada absen reason hari ini
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
