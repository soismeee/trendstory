<?php

namespace App\Http\Controllers;

use App\Models\JenisProduct;
use Illuminate\Http\Request;

class JenisProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jenis_produk.index', [
            'title' => 'Menu jenis produk',
            'jenis_produk' => JenisProduct::all()
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
        $validate = $request->validate([
            'name' => 'required|max:255'
        ]);

        JenisProduct::create($validate);
        return redirect('/dashboard/jenis_products')->with('success', 'Data jenis produk berhasil di Tambahkan');
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
        $rules = $request->validate([
            'name' => 'required|max:255'
            // 'npwp' => 'required|max:255'
        ]);

        JenisProduct::where('id', $id)->update($rules);
        return redirect('/dashboard/jenis_products')->with('edit', 'Data Jenis Produk berhasil diubah!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisProduct::destroy($id);
        return redirect('/dashboard/jenis_products')->with('hapus', 'Data Jenis Produk berhasil dihapus!!!');
    }
}
