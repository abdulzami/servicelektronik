<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\KebutuhanPengerjaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        if (!Auth::check()) {
            return redirect('/');
        }

        if (Auth::user()->level == 'admin') {
            $pendapatan_kotor = DB::table('barangs')
                ->join('pengambilan_barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
                ->whereNotNull('pengambilan_barangs.tanggal_pengambilan')
                ->sum('harga_pengerjaan');
            $total_bp = KebutuhanPengerjaan::sum('biaya');
            $pendapatan_bersih = $pendapatan_kotor - $total_bp;
            return view('admin.dashboard', compact('pendapatan_kotor', 'pendapatan_bersih'));
        } else if (Auth::user()->level == 'konsumen') {
            $id_konsumen = Auth::user()->id;
            $barangs = Barang::BarangKonsumen2($id_konsumen);
            return view('konsumen.dashboard',compact('barangs'));
        } else {
            return abort('403');
        }
    }
}
