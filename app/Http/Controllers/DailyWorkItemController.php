<?php

namespace App\Http\Controllers;

use App\Models\DailyWork;
use App\Models\DailyWorkItem;
use App\Models\Contract;
use App\Models\DailyWorkPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DailyWorkItemController extends Controller
{
    // Index: menampilkan datatables untuk items milik $dailyWork
    public function index(DailyWork $dailyWork)
    {
        $user = Auth::user();

        // Authorization: vendor hanya boleh melihat dailyWork miliknya
        if ($user->role === 'vendor' && $dailyWork->user_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }
        // dd($dailyWork->id);
        if (request()->ajax()) {
            // eager load related contract and dailyWork->user
            $items = DailyWorkItem::with(['contract', 'dailyWork.user'])
                ->where('daily_work_id', $dailyWork->id)
                ->latest();
            // dd($itemsQuery->toSql(), $itemsQuery->getBindings(), $itemsQuery->get());

            return datatables()->of($items)
                ->addIndexColumn()
                ->addColumn('job_title', function ($row) {
                    return $row->contract->job_title ?? '-';
                })
                ->addColumn('budget', function ($row) {
                    return $row->contract->budget ?? '-';
                })
                ->addColumn('company_name', function ($row) {
                    return $row->contract->company->name ?? '-';
                })
                ->addColumn('time_in', function ($item) {
                    return $item->time_in ?? '-';
                })
                ->addColumn('time_out', function ($item) {
                    return $item->time_out ?? '-';
                })
                ->addColumn('overtime_until_plan', function ($item) {
                    return $item->overtime_until_plan ?? '-';
                })
                ->addColumn('approval', function ($item) {
                    return match ($item->approval) {
                        'Approved' => '<span class="badge bg-success">Approved</span>',
                        'Rejected' => '<span class="badge bg-danger">Rejected</span>',
                        default => '<span class="badge bg-secondary">Wait</span>',
                    };
                })
                ->addColumn('action', function ($item) use ($dailyWork) {
                    $buttons = '';

                    // Edit button (vendor dapat edit sebelum approval; mps juga bisa)
                    $buttons .= '<a href="' . route('daily-work-item.edit', [$dailyWork->id, $item->id]) . '" class="btn btn-warning btn-sm ms-2 btn-edit-item" data-url="' . route('daily-work-item.edit', [$dailyWork->id, $item->id]) . '" title="Edit"><i class="fas fa-edit"></i></a>';

                    // Buttons: approve (only mps), delete (if allowed)
                    $buttons .= '<button type="button" class="btn btn-danger btn-sm ms-2 btn-delete-item" data-id="' . $item->id . '" title="Delete"><i class="fas fa-trash"></i></button>';

                    // Work Plan list link (assuming nested resource daily-work-item.plans)
                    // $buttons .= '<a href="' . route('daily-work-item.plans.index', [$dailyWork->id, $item->id]) . '" class="btn btn-info btn-sm ms-2" title="Plans"><i class="fas fa-arrow-right"></i></a>';

                    // Approve button (front-end will call approve endpoint)
                    $buttons .= '<button type="button" class="btn btn-success btn-sm ms-2 btn-approve-item" data-id="' . $item->id . '" title="Approve"><i class="fas fa-check"></i></button>';

                    return $buttons;
                })
                ->rawColumns(['action', 'approval'])
                ->make(true);
        }

        return view('pages.daily-work-item.index', compact('dailyWork'));
    }

    // Create form
    public function create(DailyWork $dailyWork)
    {
        // Authorization (opsional)
        $user = auth()->user();
        if ($user->role === 'vendor' && $dailyWork->user_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }

        // Ambil contracts untuk dropdown
        // $contracts = Contract::orderBy('contract_number')->get();
        $contracts = Contract::with('company')->orderBy('contract_number')->get();

        return view('pages.daily-work-item.create', compact('dailyWork', 'contracts'));
    }

    // Store new item
    public function store(Request $request)
    {
        $request->validate([
            'daily_work_id' => 'required|exists:daily_works,id',
            'contract_id' => 'required|exists:contracts,id',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'overtime_until_plan' => 'nullable|date_format:H:i',
            'is_absen' => 'nullable|in:0,1',
            'absen_reason' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'total_workers' => 'nullable|integer|min:0',

            'plan_name' => 'required|array|min:1',
            'plan_name.*' => 'nullable|string|max:255',
        ]);

        $dailyWork = DailyWork::findOrFail($request->daily_work_id);

        // Authorization: vendor only for their own dailyWork
        if (auth()->user()->role === 'vendor' && $dailyWork->user_id !== auth()->id) {
            abort(403, 'Unauthorized');
        }
        // store daily_work_item
        $data = $request->only([
            'daily_work_id',
            'contract_id',
            'time_in',
            'time_out',
            'overtime_until_plan',
            'is_absen',
            'absen_reason',
            'note',
            'total_workers'
        ]);

        // ensure boolean as integer 0/1
        $data['is_absen'] = $request->has('is_absen') ? 1 : 0;
        $data['approval'] = 'Wait'; // default pending

        $dailyWorkItem = DailyWorkItem::create($data);
        // dd($request->plan_name);
        // insert multiple plans
        foreach ($request->plan_name as $plan) {
            if (!empty($plan)) {
                DailyWorkPlan::create([
                    'daily_work_item_id' => $dailyWorkItem->id,
                    'plan_name' => $plan,
                ]);
            }
        }

        return redirect()->route('daily-work-item.index', $dailyWork->id)
            ->with('success', 'Daily work item berhasil disimpan.');
    }

    // Edit form
    public function edit(DailyWork $dailyWork, DailyWorkItem $dailyWorkItem)
    {
        $user = Auth::user();

        // Pastikan item belong ke dailyWork
        // if ($item->daily_work_id !== $dailyWork->id) {
        //     abort(404);
        // }

        // Vendor hanya boleh edit miliknya sendiri
        if ($user->role === 'vendor' && $dailyWork->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Ambil contracts + relasi company
        $contracts = Contract::with('company')
            ->when($user->role === 'vendor', function ($q) use ($user) {
                $q->where('company_id', $user->company_id);
            })
            ->where('status', 'active')
            ->get();

        return view('pages.daily-work-item.edit', compact('dailyWork', 'dailyWorkItem', 'contracts'));
    }

    // Update item
    public function update(Request $request, DailyWork $dailyWork, DailyWorkItem $dailyWorkItem)
    {
        // dd('ok');
        $user = Auth::user();


        // Pastikan item belong ke dailyWork
        if ($dailyWorkItem->daily_work_id !== $dailyWork->id) {
            abort(404);
        }

        // Vendor hanya boleh edit miliknya sendiri
        if ($user->role === 'vendor' && $dailyWork->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Validasi
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'time_in' => 'nullable',
            'time_out' => 'nullable',
            'overtime_until_plan' => 'nullable',
            'is_absen' => 'nullable|boolean',
            'approval' => 'nullable',
            'absen_reason' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'total_workers' => 'nullable|integer|min:0',
            'plan_name' => 'nullable|array',
            'plan_name.*' => 'nullable|string|max:255',
        ]);
        // dd('update');


        // Ambil hanya field yang boleh diupdate
        $data = $request->only([
            'contract_id',
            'time_in',
            'time_out',
            'overtime_until_plan',
            'absen_reason',
            'note',
            'total_workers',
            'approval'
        ]);

        $data['is_absen'] = $request->has('is_absen') ? 1 : 0;

        $updated = $dailyWorkItem->update($data);



        // dd($updated, $dailyWorkItem->fresh()->toArray());

        // ----------------------------
        // UPDATE MULTIPLE DAILY WORK PLANS
        // ----------------------------
        // **Pastikan relasi di-load supaya tidak null**
        $dailyWorkItem->load('dailyWorkPlan');
        // Hapus semua plan lama
        $dailyWorkItem->dailyWorkPlan()->delete();

        // Tambahkan ulang plans baru
        if ($request->has('plan_name')) {
            foreach ($request->plan_name as $plan) {
                if (!empty($plan)) {
                    $dailyWorkItem->dailyWorkPlan()->create([
                        'plan_name' => $plan
                    ]);
                }
            }
        }

        return redirect()->route('daily-work-item.index', $dailyWork->id)
            ->with('success', 'Daily work item berhasil diperbarui.');
    }

    // Destroy item (AJAX)
    public function destroy(DailyWork $dailyWork, DailyWorkItem $dailyWorkItem)
    {
        $user = Auth::user();

        if ($user->role === 'vendor') {
            if ($dailyWork->user_id !== $user->id || $dailyWorkItem->daily_work_id !== $dailyWork->id) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }
        } else {
            if ($dailyWorkItem->daily_work_id !== $dailyWork->id) {
                return response()->json(['message' => 'Not found.'], 404);
            }
        }

        $dailyWorkItem->delete();

        return response()->json(['message' => 'Item deleted.']);
    }

    // Approve item (only mps)
    public function approve(Request $request, DailyWork $dailyWork, DailyWorkItem $dailyWorkItem)
    {
        $user = Auth::user();

        if ($user->role !== 'mps') {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($dailyWorkItem->daily_work_id !== $dailyWork->id) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        // set approval = 1 (approved). You can extend payload to handle approve/reject and comments.
        $dailyWorkItem->update([
            'approval' => 'approved' // Approved
        ]);

        return response()->json(['message' => 'Item approved.']);
    }
}
