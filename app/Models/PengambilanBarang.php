<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanBarang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengambilan';

    protected $fillable = [
        'tanggal_pengambilan',
        'id_barang',
    ];

    static function cekbarang($id)
    {
        $ada = PengambilanBarang::where('id_barang', $id)->first();
        if ($ada) {
            return true;
        } else {
            return false;
        }
    }

    static function Pengambilanbarang()
    {
        $penrang =  PengambilanBarang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
            ->join('users', 'users.id', '=', 'barangs.id_konsumen')
            ->select(
                'id_pengambilan',
                'barangs.nama as nama_barang',
                'nomor_seri',
                'tipe',
                'users.nama as nama_konsumen',
                'no_hp',
                'harga_pengerjaan',
                'tanggal_pengambilan',
            )
            ->get();
        return $penrang;
    }

    static function Pengambilanbarangid($id)
    {
        $penrang =  PengambilanBarang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
            ->join('users', 'users.id', '=', 'barangs.id_konsumen')
            ->select(
                'id_pengambilan',
                'tanggal_pengambilan',
                'barangs.nama as nama_barang',
                'nomor_seri',
                'tipe',
                'users.nama as nama_konsumen',
                'no_hp',
                'harga_pengerjaan',
                'tanggal_pengambilan',
            )
            ->where('id_pengambilan', $id)->first();
        return $penrang;
    }
}
