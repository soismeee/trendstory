<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\JenisProduct;
use App\Models\MetodeBayar;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index',[
            'title' => 'Dashboard Utama',
            'pesanan' => Transaksi::all(),
            'pelanggan' => User::where('role', 3)->get(),
            'jenis_produk' => JenisProduct::all(),
            'produk' => Product::all(),

            'hari' => 0,
            'bulan' => 0,
            'bulan_ini' => Transaksi::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get(),
            'hari_ini' => Transaksi::whereDate('created_at', date('Y-m-d '))->get(),
        ]);
    }

    #################################################################################################
    // LAPORAN BARANG MASUK

    public function laporanbm(){
        return view('dashboard.barang_masuk.laporan',[
            'title' => 'Laporan barang masuk',
            'barang_masuk' => BarangMasuk::all()
        ]);
    }

    public function lihatbm(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $barang_masuk = BarangMasuk::select("*")->whereBetween('tanggal_bm', [$awal, $akhir])->get();

        if ($barang_masuk) {
            return response()->json([
                'status' => 200,
                'barang_masuk' => $barang_masuk,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak berhasil diambil',
            ]);
        }
    }

    public function cetakbm(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        return view('dashboard.barang_masuk.cetak_laporan',[
            'title' => 'Cetak Laporan Barang Masuk',
            'nilai' => 0,
            'hari' => $awal,
            'bulan' => $akhir,
            'barang' => Product::all(),
            'masuk' => 0,
            'keluar' => 0,
            'biaya' => BarangMasuk::select("*")->whereBetween('tanggal_bm', [$awal, $akhir])->get()
        ]);
    }

    ###############################################################################################
    // LAPORAN PESANAN

    public function laporanpesanan(){
        return view('dashboard.transaksi.laporan',[
            'title' => 'Laporan Pesanan',
            'transaksis' => Transaksi::all()
        ]);
    }

    public function lihatpesanan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $transaksi = Transaksi::select("*")->whereBetween('created_at', [$awal, $akhir])->get();

        if ($transaksi) {
            return response()->json([
                'status' => 200,
                'transaksi' => $transaksi,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak berhasil diambil',
            ]);
        }
    }

    public function cetakpesanan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        return view('dashboard.transaksi.cetak_laporan',[
            'title' => 'Cetak Laporan Pesanan',
            'bulan' => $akhir,
            'nilai' => 0,
            'bayar' => 0,
            'pesanan' => Transaksi::select("*")->whereBetween('created_at', [$awal, $akhir])->get()
        ]);
    }

    public function metodebayar(){
        return view('dashboard.produk.metode_bayar',[
            'title' => 'Menu Metode Bayar',
            'metodebayar' => MetodeBayar::all()
        ]);
    }

    public function savemetodebayar(Request $request){
        $validate = $request->validate([
            'nama_metode' => 'required|max:255',
            'no_rekening' => 'required'
        ]);

        MetodeBayar::create($validate);
        return redirect('/dashboard/metode_bayar')->with('success', 'Metode bayar baru berhasil di Tambahkan');
    }

    public function updatemetodebayar(Request $request, $id)
    {
        $rules = $request->validate([
            'nama_metode' => 'required|max:255',
            'no_rekening' => 'required'
        ]);

        MetodeBayar::where('id', $id)->update($rules);
        return redirect('/dashboard/metode_bayar')->with('edit', 'Data Metode bayar berhasil diubah!!!');
    }
    
    public function destroy($id){
        MetodeBayar::destroy($id);
        return redirect('/dashboard/metode_bayar')->with('hapus', 'Data Metode bayar berhasil dihapus!!!');

    }
}
