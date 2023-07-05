<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konsumens = User::Konsumen();
        return view('admin.data_konsumen', compact('konsumens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_konsumen');
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
                'jk' => 'required|max:1|min:1',
                'alamat' => 'required|max:200|min:8',
                'no_hp' => 'required|max:15|min:10',
                'username' => 'required|max:20|min:8|unique:users',
            ]
        );

        try {
            User::create([
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
                'no_hp' => $request->no_hp,
                'username' => $request->username,
                'password' => bcrypt('konsumen'),
                'level' => 'konsumen'
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal menambahkan konsumen');
        }
        return back()->with('success', 'Sukses menambahkan konsumen');
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
            $konsumen = User::Konsumenid($id_dc);
            if ($konsumen) {
                return view('admin.edit_konsumen', compact('konsumen', 'id'));
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
                'jk' => 'required|max:1|min:1',
                'alamat' => 'required|max:200|min:8',
                'no_hp' => 'required|max:15|min:10',
                'username' => 'required|max:20|min:8|unique:users,username,' . $id_dc,
            ]
        );

        try {
            User::where('id', $id_dc)->update([
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
                'no_hp' => $request->no_hp,
                'username' => $request->username,
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal update konsumen');
        }
        return back()->with('success', 'Sukses update konsumen');
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
            $konsumen = User::where('id', $id_dc)->first();
            if ($konsumen) {
                try {
                    $konsumen->delete();
                } catch (\Illuminate\Database\QueryException $ex) {
                    return back()->with('gagal', 'Gagal hapus konsumen');
                }
            }
        }
        return back()->with('success', 'Sukses hapus konsumen');
    }

    public function reset_password($id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }
        if ($id_dc) {
            $konsumen = User::where('id', $id_dc)->first();
            if ($konsumen) {
                try {
                    User::where('id', $id_dc)->update([
                        'password' => bcrypt('konsumen')
                    ]);
                } catch (\Illuminate\Database\QueryException $ex) {
                    return back()->with('gagal', 'Gagal reset password konsumen');
                }
            }
        }
        return back()->with('success', 'Sukses reset password konsumen');
    }

    public function profil()
    {
        return view('konsumen.profil');
    }

    public function ubah_identitas(Request $request, $id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        request()->validate(
            [
                'nama' => 'required|max:100|min:8',
                'alamat' => 'required|max:200|min:8',
                'no_hp' => 'required|max:15|min:10',
            ]
        );

        try {
            User::where('id', $id_dc)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
                'no_hp' => $request->no_hp,
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('gagal', 'Gagal ubah identitas');
        }
        return back()->with('success', 'Sukses ubah identitas');
    }

    public function ubah_password(Request $request, $id)
    {
        try {
            $id_dc = Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) {
            abort(403);
        }

        request()->validate(
            [
                'password_lama' => 'required|max:50|min:8',
                'password' => 'required|max:50|min:8',
                'ulangi_password' => 'required|max:50|min:8',
            ]
        );

        $password = User::Konsumenid($id_dc)->password;
        if (Hash::check($request->password_lama, $password)) {
            if ($request->password == $request->ulangi_password) {
                try {
                    User::where('id', $id_dc)->update([
                        'password' => bcrypt($request->ulangi_password)
                    ]);
                } catch (\Illuminate\Database\QueryException $ex) {
                    return back()->with('gagal', 'Gagal ubah password');
                }
                return back()->with('success', 'Sukses ubah password');
            }else{
                return back()->with('gagal', 'Gagal ubah password');
            }
        }else{
            return back()->with('gagal', 'Gagal ubah password');
        }
    }
}
