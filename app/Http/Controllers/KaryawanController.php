<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.karyawan.index', [
            'title' => 'Daftar data karyawan',
            'karyawan' => User::where('role', 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $vaslidatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'aktif' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $vaslidatedData['password'] = Hash::make($vaslidatedData['password']);
        $vaslidatedData['role'] = '2';
        
        User::create($vaslidatedData);
        return redirect('/dashboard/karyawans')->with('success', 'User karyawan baru berhasil ditambahkan!!');
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
        //
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
        // dd($request);
        $rules = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'aktif' => 'required|max:255',
            'email' => 'required',
        ]);

        if ($request->password) {
            $rules['password'] = Hash::make($request->password);
        }
        User::where('id', $id)->update($rules);
        return redirect('/dashboard/karyawans')->with('edit', 'Data karyawan berhasil diubah!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dashboard/karyawans')->with('hapus', 'Data karyawan berhasil dihapus!!!');
    }
}
