<?php

namespace App\Http\Controllers;

use App\Models\JenisProduct;
use App\Models\MetodeBayar;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home.index',[
            'title' => 'Home Trend Story',
            'products' => Product::whereNotIn('status', [1, 4])->paginate(8),
            'products_unggulan' => Product::where('status', 3)->paginate(5),
            'products_segera_launching' => Product::where('status', 1)->paginate(8)
        ]);
    }

    public function company(){
        return view('home.company.index',[
            'title' => 'Company Profile'
        ]);
    }

    public function jenisproduct($id){
        return view('home.jenis_produk.index', [
            'title' => 'Jenis Produk',
            'produk' => Product::where('jenis_id', $id)->whereNotIn('status', [1, 4])->get()
        ]);
    }

    // CRUD PRODUK
    public function product(Product $id){
        $kode = Transaksi::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 6,"0") as kodes')->first();
        $kode_trans = new Transaksi();
        $kode_trans->kodes = 'TSP' . $kode->kodes;
        return view('home.produk.index', [
            'title' => 'Produk',
            'trans' => Transaksi::latest()->get(),
            'kd' => $kode_trans,
            'produk' => $id
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'product_id' => 'required',
            'jumlah' => 'required|max:255',
            'user_id' => 'required',
            'no_transaksi' => 'required'
        ]);

        $bayar = $request->jumlah * $request->harga;
        $diskon = ($bayar / 100) * 5;
        if($request->jumlah > 20){
            $validate['nominal_bayar'] = $bayar - $diskon;
            $validate['diskon'] = $diskon;
        }else {
            $validate['nominal_bayar'] = $bayar;
            $validate['diskon'] = 0;
        }

        $validate['status'] = 0;
        $validate['karyawan'] = auth()->user()->name;
        Transaksi::create($validate);

        // update stok pada produk
        $id = $request->product_id;
        $jml = $request->jumlah;

        $product = Product::find($id);
        $stok_product = $product->stok;
        $data['stok'] = $stok_product - $jml;
        Product::where('id', $id)->update($data);
        return redirect('/home/transaksi')->with('success', 'Anda berhasil menambahkan barang ke pesanan!!!');
    }

    public function update(Request $request, $id)
    { 
        $rules = $request->validate([
            'jumlah' => 'required'
        ]);

        Transaksi::where('id', $id)->update($rules);
        return redirect('/home/transaksi')->with('edit', 'Pesanan berhasil diubah!!!');
    }

    public function batal(Request $request, $id)
    { 
        $rules['status'] = 3;
        Transaksi::where('id', $id)->update($rules);
        return redirect('/home/transaksi')->with('edit', 'Pesanan berhasil diubah!!!');
    }

    public function bayar(Request $request, $id)
    {
        
        $rules = $request->validate([
            'bayar_id' => 'required'
        ]);

        Transaksi::where('id', $id)->update($rules);
        return redirect('/home/transaksi')->with('success', 'Pembayaran berhasil dilakukan!!!');
    }

    public function buktibayar(Request $request, $id){
        
        if ($request->hasFile('bukti_bayar')) {
            $request->file('bukti_bayar')->move('buktibayar/', $request->file('bukti_bayar')->getClientOriginalName());
            $validate['bukti_bayar'] = $request->file('bukti_bayar')->getClientOriginalName();
            Transaksi::where('id', $id)->update($validate);
        }
        return redirect('/home/transaksi')->with('success', 'Bukti pembayaran berhasil di upload!!!');
    }

    public function selesai($id)
    {
        $rules['status'] = 4;
        Transaksi::where('id', $id)->update($rules);
        return redirect('/home/transaksi')->with('success', 'Terima kasih sudah memesakan produk pada toko kami!!!');
    }

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect('/home/transaksi')->with('hapus', 'Pesanan berhasil dihapus!!!');
    }

    public function trans()
    {
        return view('home.transaksi.index',[
            'title' => 'Transaksi Customer',
            'metodebayar' => MetodeBayar::all(),
            'transaksi' => Transaksi::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get()
        ]);
    }
}
