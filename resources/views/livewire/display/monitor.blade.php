<div wire:poll.5s class="display-wrapper">

    <!-- LOGO -->
    <div class="logo-top-right">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
     <div class="header-buttons">
        <a href="{{ route('display.map') }}" class="btn-header btn-map">MAP</a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn-header btn-logout">
            LOGOUT
        </a>
    </div>

    <!-- TITLE -->
    <div class="header-top">
    
    <div class="title-block">
        <h1 class="display-title">Monitoring Project - Integrated Terminal Balongan</h1>
        <h3 class="display-date">{{ now()->translatedFormat('l, d F Y') }}</h3>
    </div>

   

</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

    <!-- SCROLL WRAPPER -->
    <div id="scrollContainer" class="scroll-container">

        <!-- TABEL UTAMA -->
        <div class="table-responsive">
            <table class="display-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pekerjaan</th>
                        <th>Anggaran</th>
                        <th>Pelaksana</th>
                        <th>Jumlah Pekerja Yang Masuk</th>
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
                            <td class="text-success fw-bold">{{ $item->contract->budget }}</td>
                            <td>{{ $item->contract->company->name }}</td>

                            <td class="{{ $item->is_absen ? 'off-red' : '' }}">
                                {{ $item->is_absen ? 'OFF' : ($item->total_workers ?? '0') }}
                            </td>
                            <td class="{{ $item->is_absen ? 'off-red' : '' }}">{{ $item->is_absen ? 'OFF' : ($item->time_in ?? '-') }}</td>
                            <td class="{{ $item->is_absen ? 'off-red' : '' }}">{{ $item->is_absen ? 'OFF' : ($item->time_out ?? '-') }}</td>
                            <td class="{{ $item->is_absen ? 'off-red' : '' }}">{{ $item->is_absen ? 'OFF' : ($item->overtime_until_plan ?? '-') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4" style="font-size:28px;">
                                Tidak ada data untuk ditampilkan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ABSEN REASON -->
        <h3 class="absen-title">KETERANGAN:</h3>

        <table class="absen-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Perusahaan</th>
                    <th>Alasan</th>
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
                        <td colspan="4" class="text-center py-3">
                            Tidak ada absen reason hari ini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- AUTO SCROLL SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('scrollContainer');
            const isTV = window.innerWidth >= 1400;

            if (!isTV) return;

            let speed = 1;
            let timer;

            function startScroll() {
                timer = setInterval(() => {
                    container.scrollTop += speed;
                    if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
                        container.scrollTop = 0;
                    }
                }, 50);
            }

            if (container.scrollHeight > container.clientHeight) {
                startScroll();
            }
        });
    </script>

</div>
