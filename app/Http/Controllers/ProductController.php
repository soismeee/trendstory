<?php

namespace App\Http\Controllers;

use App\Models\JenisProduct;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode = Product::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode_product = new Product();
        $kode_product->kodes = 'KD' . $kode->kodes;
        return view('dashboard.produk.index', [
            'title' => 'Semua Produk',
            'jenis_produk' => JenisProduct::all(),
            'products' => Product::all(),
            'kd' => $kode_product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Product::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode_product = new Product();
        $kode_product->kodes = 'KD' . $kode->kodes;
        return view('dashboard.produk.index', [
            'title' => 'Semua Produk',
            'jenis_produk' => JenisProduct::all(),
            'products' => Product::where('status', 1)->get(),
            'kd' => $kode_product,
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
        // dd($request);
        $validate = $request->validate([
            'nama' => 'required|max:255',
            'kd_barang' => 'required|max:255',
            'jenis_id' => 'required|max:255',
            'stok' => 'required|max:255',
            'harga' => 'required',
            'satuan' => 'required|max:255',
            'detail' => 'required',
            'status' => 'required|max:10'
        ]);

        if ($request->status == 1) {
            $validate['color'] = 'warning';
        }else if($request->status == 2){
            $validate['color'] = 'success';
        }else if($request->status == 3){
            $validate['color'] = 'info';
        }else if($request->status == 4){
            $validate['color'] = 'danger';
        }
        
        Product::create($validate);
        return redirect('/dashboard/products')->with('success', 'Data produk berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.produk.upload_image', [
            'title' => 'Upload gambar produk',
            'produk' => Product::find($id)
        ]);
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
            'nama' => 'required|max:255',
            'jenis_id' => 'required|max:255',
            'stok' => 'required|max:255',
            'harga' => 'required',
            'status' => 'required|max:10',
            'detail' => 'required',
            'satuan' => 'required|max:100'
        ]);

        if ($request->status == 1) {
            $rules['color'] = 'warning';
        }else if($request->status == 2){
            $rules['color'] = 'success';
        }else if($request->status == 3){
            $rules['color'] = 'info';
        }else if($request->status == 4){
            $rules['color'] = 'danger';
        }

        Product::where('id', $id)->update($rules);
        return redirect('/dashboard/products')->with('edit', 'Data Produk berhasil diubah!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/dashboard/products')->with('hapus', 'Data Produk berhasil dihapus!!!');
    }

    public function upload(Request $request, $id)
    {
        // dd($request);
        if ($request->hasFile('cover')) {
            $request->file('cover')->move('coverproduct/', $request->file('cover')->getClientOriginalName());
            $validate['cover'] = $request->file('cover')->getClientOriginalName();
            Product::where('id', $id)->update($validate);
        }

        if ($request['photo']) {
            foreach ($request->file('photo') as $pt) {
                Gallery::create([
                    'product_id' => $id,
                    'name_photo' => $pt->getClientOriginalName(),
                ]);
                $pt->move('imageproduct/', $pt->getClientOriginalName());
            }
        }
        return redirect('/dashboard/products')->with('success', 'Foto produk berhasil di upload!!!');
    }
}
