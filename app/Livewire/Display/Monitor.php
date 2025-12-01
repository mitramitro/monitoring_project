<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Models\DailyWorkItem;
use Illuminate\Support\Carbon;

class Monitor extends Component
{
    public function render()
    {
        // ==========================
        //  QUERY TABEL UTAMA
        // ==========================
        $items = DailyWorkItem::with([
            'contract.company',
            'dailyWork'
        ])
            ->where('approval', 'approved')
            ->whereHas('contract', function ($q) {
                $q->where('status', 'progress');
            })
            ->whereHas('dailyWork', function ($q) {
                $q->whereDate('date', Carbon::today());
            })
            ->orderBy('id', 'desc')
            ->get();


        // dd($items);
        // ==========================
        //  QUERY ABSEN REASON
        // ==========================
        $listAbsen = DailyWorkItem::with(['contract.company', 'dailyWork'])
            ->where('is_absen', 1)
            ->whereNotNull('absen_reason')
            ->where('absen_reason', '!=', '')
            ->where('approval', 'approved')
            ->whereHas('contract', fn($q) => $q->where('status', 'progress'))
            ->whereHas(
                'dailyWork',
                fn($q) =>
                $q->whereDate('date', Carbon::today())
            )
            ->orderBy('id', 'desc')
            ->get();


        return view('livewire.display.monitor', [
            'items'     => $items,
            'listAbsen' => $listAbsen,
        ]);
    }
}
