<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'Pengaturan';
        $page_description = 'Pengaturan';
        $data = User::find(Auth::user()->id);
        $divisions = Division::all();
        return view('pages.pengaturan.index', compact('page_title', 'page_description', 'data', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required',
            'username' => 'required|unique:users,username,' . $id,
        ]);

        $data = [
            'name' => $request->name,
            'position' => $request->jabatan,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $crew = User::findOrFail($id);

        $crew->update($data);

        return redirect()->route('pengaturan.index')->with('success', 'Berhasil ubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
