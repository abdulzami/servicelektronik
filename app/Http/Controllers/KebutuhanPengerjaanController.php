<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\KebutuhanPengerjaan;
use App\Models\PengambilanBarang;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KebutuhanPengerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        $adagak = PengambilanBarang::cekbarang($id_dc);

        $kepengs = KebutuhanPengerjaan::Kebutuhanpengerjaan($id_dc);
        $nama_barang = Barang::Barangid($id_dc)->nama;
        if($adagak == true){
            return redirect('m-barang')->with('gagal', 'Tidak bisa membuka kebutuhan pengerjaan');
        }else{
            return view('admin.data_kebutuhan_pengerjaan', compact('kepengs', 'nama_barang', 'id'));
        }
        
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

        $konsumens = User::Konsumen();
        $nama_barang = Barang::Barangid($id_dc)->nama;
        return view('admin.create_kebutuhan_pengerjaan', compact('konsumens', 'id', 'nama_barang'));
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
                'nama_kebutuhan' => 'required|max:100|min:2',
                'biaya' => 'required|max:13|min:3',
            ]
        );

        try {
            $id_barang = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        $biaya = $request->biaya;
        $biaya = str_replace(".", "", $biaya);

        try {
            KebutuhanPengerjaan::create([
                'nama_kebutuhan' => $request->nama_kebutuhan,
                'biaya' => $biaya,
                'id_barang' => $id_barang
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal menambahkan kebutuhan pengerjaan');
        }
        return back()->with('success', 'Sukses menambahkan kebutuhan pengerjaan');
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
    public function edit($id, $id_barang)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        try {
            $barang = Crypt::decryptString($id_barang);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        if ($id_dc) {
            if ($id_barang) {
                $nama_barang = Barang::Barangid($barang)->nama;
                $kepeng = KebutuhanPengerjaan::Kebutuhanpengerjaanid($id_dc);
                if ($kepeng) {
                    return view('admin.edit_kebutuhan_pengerjaan', compact('kepeng', 'id', 'id_barang', 'nama_barang'));
                }
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
                'nama_kebutuhan' => 'required|max:100|min:2',
                'biaya' => 'required|max:13|min:3',
            ]
        );

        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        $biaya = $request->biaya;
        $biaya = str_replace(".", "", $biaya);
        
        try {
            KebutuhanPengerjaan::where('id', $id_dc)->update([
                'nama_kebutuhan' => $request->nama_kebutuhan,
                'biaya' => $biaya,
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal update kebutuhan pengerjaan');
        }
        return back()->with('success', 'Sukses update kebutuhan pengerjaan');
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
            $barang = KebutuhanPengerjaan::where('id', $id_dc)->first();
            if ($barang) {
                try {
                    $barang->delete();
                } catch (\Illuminate\Database\QueryException $ex) {
                    return back()->with('gagal', 'Gagal hapus barakebutuhan pengerjaanng');
                }
            }
        }
        return back()->with('success', 'Sukses hapus kebutuhan pengerjaan');
    }
}
