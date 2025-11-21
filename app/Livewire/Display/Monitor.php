<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Models\DailyWorkItem;

class Monitor extends Component
{
    public function render()
    {
        // Query display
        $items = DailyWorkItem::with([
            'contract.company',    // job_title, budget, company
            'dailyWork'            // date, etc
        ])
            ->where('approval', 'approved')
            ->whereHas('contract', function ($q) {
                $q->where('status', 'active');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.display.monitor', compact('items'));
    }
}
