<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KebutuhanPengerjaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Crypt;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::Barang();
        return view('admin.data_barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $konsumens = User::Konsumen();
        return view('admin.create_barang', compact('konsumens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                'nama' => 'required|max:100|min:8',
                'nomor_seri' => 'required|max:100|min:4',
                'tipe' => 'required|max:200|min:8',
                'tanggal_masuk' => 'date|required',
                'pemilik_barang' => 'required',
                'deskripsi' => 'required'
            ]
        );
        try {
            $pemilik_barang = Crypt::decryptString($request->pemilik_barang);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        try {
            Barang::create([
                'nama' => $request->nama,
                'nomor_seri' => $request->nomor_seri,
                'tipe' => $request->tipe,
                'tanggal_masuk' => $request->tanggal_masuk,
                'id_konsumen' => $pemilik_barang,
                'deskripsi' => $request->deskripsi,
                'status_barang' => 'Belum dikerjakan'
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal menambahkan barang');
        }
        return back()->with('success', 'Sukses menambahkan barang');
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
        $konsumens = User::Konsumen();
        if ($id_dc) {
            $barang = Barang::Barangid($id_dc);
            $kepengs = KebutuhanPengerjaan::Kebutuhanpengerjaansum($id_dc);
            if ($barang) {
                if ($barang->tanggal_pengambilan) {
                    return redirect('m-barang')->with('gagal', 'Tidak bisa membuka edit barang');
                } else {
                    return view('admin.edit_barang', compact('konsumens', 'barang', 'kepengs', 'id'));
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
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        request()->validate(
            [
                'nama' => 'required|max:100|min:8',
                'nomor_seri' => 'required|max:100|min:4',
                'tipe' => 'required|max:200|min:8',
                'tanggal_masuk' => 'date|required',
                'pemilik_barang' => 'required',
                'status_barang' => 'required',
                'deskripsi' => 'required'
            ]
        );
        $harga_pengerjaan = null;
        $tanggal_selesai = null;
        if ($request->status_barang == 'Selesai' || $request->status_barang == 'Tidak bisa dikerjakan') {
            request()->validate(
                [
                    'harga_pengerjaan' => 'required',
                    'tanggal_selesai' => 'required'
                ]
            );
            $harga_pengerjaan = $request->harga_pengerjaan;
            $harga_pengerjaan = str_replace(".", "", $harga_pengerjaan);
            $tanggal_selesai = $request->tanggal_selesai;
        }
        try {
            $pemilik_barang = Crypt::decryptString($request->pemilik_barang);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        $barang = Barang::Barangid($id_dc);
        if ($barang->tanggal_pengambilan) {
            abort(403);
        } else {
            try {
                Barang::where('id', $id_dc)->update([
                    'nama' => $request->nama,
                    'nomor_seri' => $request->nomor_seri,
                    'tipe' => $request->tipe,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'id_konsumen' => $pemilik_barang,
                    'status_barang' => $request->status_barang,
                    'harga_pengerjaan' => $harga_pengerjaan,
                    'tanggal_selesai' => $tanggal_selesai,
                    'deskripsi' => $request->deskripsi
                ]);
            } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('gagal', 'Gagal update barang');
            }
            return back()->with('success', 'Sukses update barang');
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
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        if ($id_dc) {
            $barang = Barang::where('id', $id_dc)->first();
            if ($barang) {
                try {
                    $barang->delete();
                } catch (\Illuminate\Database\QueryException $ex) {
                    return back()->with('gagal', 'Gagal hapus barang');
                }
            }
        }
        return back()->with('success', 'Sukses hapus barang');
    }

    public function barang_konsumen()
    {
        $id_konsumen = Auth::user()->id;
        
        $barangs = Barang::BarangKonsumen($id_konsumen);
        return view('konsumen.barang',compact('barangs'));
    }

    public function barang_konsumen2()
    {
        $id_konsumen = Auth::user()->id;
        
        $barangs = Barang::BarangKonsumen2($id_konsumen);
        return view('konsumen.barang',compact('barangs'));
    }
}
