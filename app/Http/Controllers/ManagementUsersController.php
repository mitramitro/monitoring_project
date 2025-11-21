<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GantiPasswordRequest;
use App\Http\Requests\ManagementUsersRequest;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ManagementUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('company')->get();

            return DataTables::of($users)
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('management-users.edit', $data->id) . '" title="Edit User" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                               </a><br/>';

                    $button .= '<a href="' . route('management-users.getGantiPassword', $data->id) . '" title="Ganti Password" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-key"></i> Ganti Password
                                </a><br/>';

                    $button .= '<button type="button" title="Hapus User" id="' . $data->id . '" class="delete btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>';

                    return $button;
                })
                ->addColumn('company', function ($data) {
                    return $data->company ? $data->company->name : '-';
                })
                ->addColumn('handphone', function ($data) {
                    return $data->company ? $data->company->handphone : '-';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Management Users';
        $page_description = 'Admin Dashboard';
        return view('pages.management-users.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Tambah User';
        $page_description = 'Admin Dashboard';
        $companies = Company::all();
        return view('pages.management-users.create', compact('page_title', 'page_description', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagementUsersRequest $request)
    {
        //sudah ada di form request
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users,username',
        //     'password' => 'required|string|min:6|confirmed',
        //     'role' => 'required|string',
        //     'company_id' => 'nullable|exists:companies,id',
        // ]);

        // Jika pilih "Lainnya", buat perusahaan baru
        if ($request->company_id == 0) {
            $company = Company::create([
                'name' => $request->company_other,
            ]);
            $companyId = $company->id;
        } else {
            $companyId = $request->company_id;
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $companyId,
        ]);

        return redirect()->route('management-users.index')
            ->with('success', 'Berhasil menambahkan user baru.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = 'Edit User';
        $page_description = 'Admin Dashboard';
        $user = User::findOrFail($id);
        $companies = Company::all();

        return view('pages.management-users.edit', compact('page_title', 'page_description', 'user', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();



        User::findOrFail($id)->update($data);

        return redirect()->route('management-users.index')
            ->with('success', 'Berhasil mengubah data user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            Storage::delete($user->photo);
        }

        $user->delete();
    }

    /**
     * Form ganti password.
     */
    public function getGantiPassword($id)
    {
        $page_title = 'Ganti Password';
        $page_description = 'Halaman Ganti Password';
        return view('pages.management-users.ganti-password', compact('page_title', 'page_description', 'id'));
    }

    /**
     * Proses ganti password.
     */
    public function postGantiPassword(GantiPasswordRequest $request)
    {
        User::findOrFail($request->users_id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('management-users.index')
            ->with('success', 'Berhasil mengubah password user.');
    }
}
