<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 2) {
            return view('dashboard.transaksi.index',[
                'title' => 'Transaksi Pelanggan',
                'transaksi' => Transaksi::orderBy('id', 'DESC')->get()
            ]);
        } else {
            return view('home.transaksi.index',[
                'title' => 'Transaksi Customer',
                'transaksi' => Transaksi::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get()
            ]);   
        }
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
        // 
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
            'status' => 'required|max:255'
        ]);
        $rules['karyawan'] = auth()->user()->name;
        Transaksi::where('id', $id)->update($rules);
        return redirect('/dashboard/transaksi')->with('success', 'Data Pesanan Produk berhasil diproses!!!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
