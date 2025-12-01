<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\DailyWorkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DisplayController extends Controller
{
    public function display()
    {
        // nanti kita isi query datanya di sini
        return view('pages.display.index');
    }

    public function map()
    {
        $items = DailyWorkItem::with([
            'contract.company',
            'dailyWork'
        ])
            ->where('approval', 'approved')
            ->whereHas('contract', function ($q) {
                $q->where('status', 'progress')
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude');
            })
            ->whereHas('dailyWork', function ($q) {
                $q->whereDate('date', Carbon::today());
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.display.mapdisplay', compact('items'));
    }

    // public function getContractLocations()
    // {
    //     $contracts = Contract::whereNotNull('latitude')
    //         ->whereNotNull('longitude')
    //         ->get([
    //             'id',
    //             'contract_number',
    //             'job_title',
    //             'latitude',
    //             'longitude'
    //         ]);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $contracts
    //     ]);
    // }
}
