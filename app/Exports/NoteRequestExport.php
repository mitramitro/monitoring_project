<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NoteRequestExport implements FromView
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
        return view('pages.nota-permintaan.excel', [
            'items' => $this->items
        ]);
    }
}
