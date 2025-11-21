@extends('layouts.default')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">{{ $page_title }}</h2>
            <p class="text-muted mb-0">{{ $page_description }}</p>
        </div>
    </div>

    {{-- Dashboard Content --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title mb-2">Selamat Datang 👋</h5>
                    <p class="text-muted">
                        Halo, <strong>{{ Auth::user()->name ?? 'User' }}</strong>!<br>
                        Anda berhasil login ke sistem Monitoring Project.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Sistem</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">📅 Tanggal hari ini: {{ now()->translatedFormat('l, d F Y') }}</li>
                        <li class="list-group-item">👤 Username: {{ Auth::user()->username ?? '-' }}</li>
                        <li class="list-group-item">🕒 Login terakhir: {{ Auth::user()->updated_at->diffForHumans() ?? '-' }}</li>
                        <li class="list-group-item">🔒 Role: {{ Auth::user()->role ?? '-' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
