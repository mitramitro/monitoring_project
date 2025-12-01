<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Jika AJAX → DataTables server-side
        if ($request->ajax()) {
            $query = Company::query()->latest();;

            return DataTables::of($query)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     return '
                //         <button class="btn btn-sm btn-primary editBtn" data-id="' . $row->id . '">Edit</button>
                //         <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $row->id . '">Delete</button>
                //     ';
                // })
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('company.edit', $data->id) . '" title="Edit" tooltip="Edit" class="btn btn-sm btn-primary editBtn"><i class="fas fa-edit"></i></a>';
                    // $button .= '<button type="button" class="btn btn-danger btn-sm ms-2 delete" data-id="' . $data->id . '" title="Delete"><i class="fas fa-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.company.index');
    }
    public function create()
    {
        return view('pages.company.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pic'          => 'nullable|string|max:255',
            'safety_man'   => 'nullable|string|max:255',
            'handphone'    => 'nullable|string|max:20',
        ]);

        Company::create($request->only([
            'name',
            'pic',
            'safety_man',
            'handphone'
        ]));

        // return response()->json(['success' => true]);
        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        // return response()->json($company);
        return view('pages.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name'         => 'required|string|max:255',
            'pic'          => 'nullable|string|max:255',
            'safety_man'   => 'nullable|string|max:255',
            'handphone'    => 'nullable|string|max:20',
        ]);
        // dd($request->all());
        $company->update($request->only([
            'name',
            'pic',
            'safety_man',
            'handphone'
        ]));

        // return response()->json(['success' => true]);
        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['success' => true]);
    }
}
