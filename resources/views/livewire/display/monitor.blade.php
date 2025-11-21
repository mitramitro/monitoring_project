<div wire:poll.5s class="display-wrapper">

    <div class="text-center">
        <h1 class="display-title" >
            Monitoring Project - Integrated Terminal Balongan
        </h1>

        <h3 class="display-date">
            {{ now()->translatedFormat('l, d F Y') }}
        </h3>
    </div>

    <div class="table-responsive">
        <table class="table display-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Anggaran</th>
                    <th>Pelaksana</th>
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

                        <td class="text-primary fw-bold">
                            {{ $item->time_in ?? '-' }}
                        </td>

                        <td class="text-primary fw-bold">
                            {{ $item->time_out ?? '-' }}
                        </td>

                        <td class="text-warning fw-bold">
                            {{ $item->overtime_until_plan ?? '-' }}
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

</div>
