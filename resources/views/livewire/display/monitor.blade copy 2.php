<div wire:poll.5s class="display-wrapper">
    <div class="logo-top-right">
      <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>

    <div class="text-center">
        <h1 class="display-title">
            Monitoring Project - Integrated Terminal Balongan
        </h1>

        <h3 class="display-date">
            {{ now()->translatedFormat('l, d F Y') }}
        </h3>
    </div>

    <!-- ================= TABEL UTAMA ================= -->
    <div class="table-responsive">
        <table class="table display-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Anggaran</th>
                    <th>Pelaksana</th>
                    <th>Jumlah Pekerja yg Masuk</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Rencana Lembur</th>
                </tr>
            </thead>

           <tbody>
                @forelse($items as $i => $item)
                    <tr>
                        <td class="fw-bold text-center">{{ $i + 1 }}</td>

                        <td class="fw-semibold">
                            {{ $item->contract->job_title }}
                        </td>

                        <td class="text-success fw-bold">
                            {{ $item->contract->budget }}
                        </td>

                        <td>
                            {{ $item->contract->company->name }}
                        </td>
                        
                        {{-- JUMLAH PEKERJA YG MASUK --}}
                        <td class="text-center fw-bold">
                            {{ $item->is_absen ? 'OFF' : ($item->total_workers ?? '0') }}
                        </td>

                        {{-- TIME IN --}}
                        <td class="text-primary fw-bold">
                            {{ $item->is_absen ? 'OFF' : ($item->time_in ?? '-') }}
                        </td>

                        {{-- TIME OUT --}}
                        <td class="text-primary fw-bold">
                            {{ $item->is_absen ? 'OFF' : ($item->time_out ?? '-') }}
                        </td>

                        {{-- OVERTIME --}}
                        <td class="text-warning fw-bold">
                            {{ $item->is_absen ? 'OFF' : ($item->overtime_until_plan ?? '-') }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5" style="font-size:30px;">
                            Tidak ada data untuk ditampilkan
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
    <!-- ================= END TABEL UTAMA ================= -->

    <br><br>

    <!-- ================= TABEL ABSEN REASON ================= -->
    <h3 class="absen-title">ABSEN REASON TODAY</h3>

    <table class="absen-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pekerjaan</th>
                <th>Nama Perusahaan</th>
                <th>Absen Reason</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($listAbsen as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->contract->job_title }}</td>
                    <td>{{ $item->contract->company->name }}</td>
                    <td>{{ $item->absen_reason }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:15px;">
                        Tidak ada absen reason hari ini
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- ================= END TABEL ABSEN REASON ================= -->

</div>
