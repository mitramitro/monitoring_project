<?php

namespace App\Http\Controllers;

use App\Models\DailyWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $dailyWorks = DailyWork::with('user')->latest()->get();
            return datatables()->of($dailyWorks)
                ->addIndexColumn()
                // ->addColumn('username', function ($dailyWork) {
                //     return $dailyWork->user->username;
                // })
                ->addColumn('action', function ($data) {

                    $user = auth()->user();

                    // Jika user tidak login → kosongkan action
                    if (!$user) {
                        return '';
                    }

                    $buttons = '';

                    // Jika user bukan vendor → boleh edit
                    if ($user->role !== 'vendor') {
                        $buttons .= '<a href="' . route('daily-work.edit', $data->id) . '" 
                        title="Edit" 
                        class="btn btn-warning btn-sm ms-2">
                        <i class="fas fa-edit"></i>
                     </a>';
                    }

                    // Tombol Work Item → semua role boleh
                    $buttons .= '<a href="' . route('daily-work-item.index', ['dailyWork' => $data->id]) . '" 
                    title="Work Item" 
                    class="btn btn-info btn-sm ms-2">
                    <i class="fas fa-arrow-right"></i>
                 </a>';

                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.daily-work.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'mps') {
            abort(403, 'Unauthorized');
        }
        return view('pages.daily-work.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);
        $user = Auth::user();
        DailyWork::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'note' => $request->note,
        ]);
        return redirect()->route('daily-work.index')->with('success', 'Daily work created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyWork $dailyWork)
    {
        return view('pages.daily-work.edit', compact('dailyWork'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyWork $dailyWork)
    {
        $request->validate([
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $dailyWork->update([
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('daily-work.index')->with('success', 'Daily work updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
