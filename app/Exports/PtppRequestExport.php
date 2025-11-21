<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PtppRequestExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function view(): View
    {
        return view('pages.permohonan-ptpp.excel', [
            'items' => $this->items
        ]);
    }
}
