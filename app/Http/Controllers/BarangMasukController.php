<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.barang_masuk.index',[
            'title' => 'Data Barang Masuk',
            'barang_masuk' => BarangMasuk::all()
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = BarangMasuk::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 6,"0") as kodes')->first();
        $kode_trans = new BarangMasuk();
        $kode_trans->kodes = 'BMTS' . $kode->kodes;
        return view('dashboard.barang_masuk.create',[
            'title' => 'Form input barang masuk',
            'products' => Product::all(),
            'no_bm' => BarangMasuk::latest()->get(),
            'kd' => $kode_trans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'jumlah' => 'required',
            'product' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect('/dashboard/barang_masuks')->with('error', 'Mohon maaf, proses input barang tidak berhasil!!!');
        } else {
            if ($request->product) {
                $jumlah = $request->jumlah;
                $trans_id = $request->trans_id + 1;

                foreach ($request->product as $key => $p_id) {

                    $product = Product::find($p_id);
                    $stok_product = $product->stok;
                    $data['stok'] = $stok_product + $jumlah[$key];

                    Product::where('id', $p_id)->update($data);

                    DetailBarangMasuk::create([
                        'bm_id' => $trans_id,
                        'product_id' => $p_id,
                        'jumlah' => $jumlah[$key],
                    ]);
                }
            }

            $trans = new BarangMasuk();
            $trans->no_bm = $request->no_trans;
            $trans->user_id = auth()->user()->id;
            $trans->tanggal_bm = date(now());
            $trans->total_bm = $request->grand_total;
            $trans->save();
            return redirect('/dashboard/barang_masuks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Product::find($id);
        if ($produk) {
            return response()->json([
                'status' => 200,
                'produks' => $produk,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak berhasil diambil',
            ]);
        }
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
        $validate = Validator::make($request->all(), [
            'jumlah' => 'required',
            'product' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect('/dashboard/barang_masuks')->with('error', 'Mohon maaf, proses edit barang tidak berhasil!!!');
        } else {
            if ($request->product) {
                $jumlah = $request->jumlah;
                $jumlah_old = $request->jumlah_old;
                $total = 0;

                foreach ($request->product as $key => $p_id) {

                    $product = Product::find($p_id);
                    $stok_product = $product->stok;
                    $data['stok'] = ($stok_product - $jumlah_old[$key]) + $jumlah[$key];

                    Product::where('id', $p_id)->update($data);

                    $rules = ([
                        'product_id' => $p_id,
                        'jumlah' => $jumlah[$key],
                    ]);
                    DetailBarangMasuk::where('id', $p_id)->update($rules);
                }
                $total = $jumlah+$jumlah;
            }

            $new = ([
                'total_bm' => $total
            ]);
            BarangMasuk::where('id', $id)->update($new);
            return redirect('/dashboard/barang_masuks');
        }
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
