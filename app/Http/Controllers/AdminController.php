<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Admin::all();
        return view('dashboard.admin.admin_read', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);

        $admin = Admin::create([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        $admin->save();
        return redirect()->route('dashboard.admin')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::find($id);
        return view('dashboard.admin.admin_update', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);

        $admin = Admin::find($id);
        $admin->update([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => $request->role,
        ]);
        $admin->save();
        return redirect()->route('dashboard.admin')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('dashboard.admin')->with('success', 'Data berhasil dihapus');
    }
}
