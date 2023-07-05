<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\PengambilanBarang;
use App\Models\KebutuhanPengerjaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PengambilanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penrangs = PengambilanBarang::Pengambilanbarang();
        return view('admin.data_pengambilan_barang', compact('penrangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        $adagak = PengambilanBarang::cekbarang($id_dc);

        $harga_pengerjaan = Barang::Barangid($id_dc)->harga_pengerjaan;
        $status = Barang::Barangid($id_dc)->status_barang;
        $nama_barang = Barang::Barangid($id_dc)->nama;
        $kepengs = KebutuhanPengerjaan::Kebutuhanpengerjaansum($id_dc);
        if ($adagak == true) {
            return redirect('m-barang')->with('gagal', 'Tidak bisa membuka pengambilan barang');
        } else {
            if ($status == 'Selesai' || $status == 'Tidak bisa dikerjakan') {
                return view('admin.create_pengambilan_barang', compact('harga_pengerjaan', 'nama_barang', 'kepengs', 'id'));
            } else {
                return redirect('m-barang')->with('gagal', 'Belum bisa membuka pengambilan barang');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        request()->validate(
            [
                'tanggal_pengambilan' => 'required',
            ]
        );

        try {
            $id_barang = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        $status = Barang::Barangid($id_barang)->status_barang;

        if ($status == 'Selesai' || $status == 'Tidak bisa dikerjakan') {
            try {
                PengambilanBarang::create([
                    'id_barang' => $id_barang,
                    'tanggal_pengambilan' => $request->tanggal_pengambilan
                ]);
            } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('gagal', 'Gagal melakukan pengambilan barang');
            }
            return redirect('m-barang')->with('success', 'Sukses melakukan pengambilan barang');
        } else {
            abort(403);
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
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        if ($id_dc) {
            $penrang = PengambilanBarang::Pengambilanbarangid($id_dc);
            if ($penrang) {
                return view('admin.edit_pengambilan_barang', compact('penrang', 'id'));
            }
        }
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
        request()->validate(
            [
                'tanggal_pengambilan' => 'required',
            ]
        );

        try {
            $id_penrang = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        try {
            PengambilanBarang::where('id_pengambilan', $id_penrang)->update([
                'tanggal_pengambilan' => $request->tanggal_pengambilan
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal update pengambilan barang');
        }

        return back()->with('success', 'Sukses update pengambilan barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        if ($id_dc) {
            $penrang = PengambilanBarang::where('id_pengambilan', $id_dc)->first();
            if ($penrang) {
                $penrang->delete();
            }
        }
        return back()->with('success', 'Sukses hapus pengambilan barang');
    }

    public function cetaknota($id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        $nota = PengambilanBarang::Pengambilanbarangid($id_dc);
        return view('admin.cetak_nota', compact('nota'));
    }

    public function cetaknota2($id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        if ($id_dc) {
            $id_konsumen = Auth::user()->id;
            $nota = PengambilanBarang::Pengambilanbarangid($id_dc);
            return view('konsumen.cetak_nota', compact('nota'));
        }else{
            return redirect('barang')->with('gagal', 'Belum bisa cetak nota ');
        }
    }
}
