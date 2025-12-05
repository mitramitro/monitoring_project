<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        // Jika AJAX → DataTables server-side
        if ($request->ajax()) {
            $query = Contract::with('company')->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('company_name', function ($row) {
                    return $row->company->name ?? '-';
                })
                ->addColumn('action', function ($data) {
                    $btn  = '<a href="' . route('contracts.edit', $data->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                    // $btn .= '<button data-id="' . $data->id . '" class="btn btn-sm btn-danger ms-1 btn-delete"><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.contracts.index');
    }

    public function create()
    {
        $companies = Company::all();
        return view('pages.contracts.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract_number' => 'required|string|max:100',
            'budget'          => 'nullable|string|max:255',
            'job_title'       => 'nullable|string|max:255',
            'pic'             => 'nullable|string|max:255',
            'safety_man'      => 'nullable|string|max:255',
            'handphone'       => 'nullable|string|max:255',
            'company_id'      => 'required|integer',
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',
            'status'          => 'required|string|max:50',
        ]);

        Contract::create($request->only([
            'contract_number',
            'budget',
            'job_title',
            'company_id',
            'pic',
            'safety_man',
            'handphone',
            'latitude',
            'longitude',
            'status'
        ]));

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    public function edit(Contract $contract)
    {
        $companies = Company::all();
        return view('pages.contracts.edit', compact('contract', 'companies'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'contract_number' => 'required|string|max:100',
            'budget'          => 'nullable|string|max:255',
            'job_title'       => 'nullable|string|max:255',
            'company_id'      => 'required|integer',
            'pic'             => 'nullable|string|max:255',
            'safety_man'      => 'nullable|string|max:255',
            'handphone'       => 'nullable|string|max:255',
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',
            'status'          => 'required|string|max:50',
        ]);

        $contract->update($request->only([
            'contract_number',
            'budget',
            'job_title',
            'company_id',
            'pic',
            'safety_man',
            'handphone',
            'latitude',
            'longitude',
            'status'
        ]));

        return redirect()->route('contracts.index')->with('success', 'Contract updated successfully.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json(['success' => true]);
    }
}
