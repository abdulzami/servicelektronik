<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nomor_seri',
        'tipe',
        'tanggal_masuk',
        'id_konsumen',
        'status_barang',
        'tanggal_selesai',
        'harga_pengerjaan',
        'deskripsi'
    ];

    static function Barang()
    {
        $barangs = Barang::join('users','users.id','=','barangs.id_konsumen')->select(
        'barangs.id as id_barang',
        'pengambilan_barangs.id_barang as pb_id_barang',
        'tanggal_pengambilan',
        'barangs.nama as nama_barang',
        'nomor_seri',
        'tipe',
        'tanggal_masuk',
        'users.nama as nama_konsumen',
        'users.no_hp',
        'status_barang',
        'tanggal_selesai',
        'harga_pengerjaan',
        'deskripsi'
        )->leftJoin('pengambilan_barangs','barangs.id','=','pengambilan_barangs.id_barang')
        ->orderBy('barangs.id','DESC')->get();
        return $barangs;
    }

    static function Barangid($id)
    {
        $barangs = Barang::where('id',$id)->leftJoin('pengambilan_barangs','barangs.id','=','pengambilan_barangs.id_barang')
        ->first();
        return $barangs;
    }

    static function BarangKonsumen($id)
    {
        $barangs = Barang::join('users','users.id','=','barangs.id_konsumen')->select(
        'id_pengambilan',
        'barangs.id as id_barang',
        'pengambilan_barangs.id_barang as pb_id_barang',
        'tanggal_pengambilan',
        'barangs.nama as nama_barang',
        'nomor_seri',
        'tipe',
        'tanggal_masuk',
        'status_barang',
        'tanggal_selesai',
        'harga_pengerjaan',
        )->leftJoin('pengambilan_barangs','barangs.id','=','pengambilan_barangs.id_barang')
        ->where('users.id',$id)
        ->orderBy('barangs.id','DESC')->get();
        return $barangs;
    }

    static function BarangKonsumen2($id)
    {
        $barangs = Barang::join('users','users.id','=','barangs.id_konsumen')->select(
        'id_pengambilan',
        'barangs.id as id_barang',
        'pengambilan_barangs.id_barang as pb_id_barang',
        'tanggal_pengambilan',
        'barangs.nama as nama_barang',
        'nomor_seri',
        'tipe',
        'tanggal_masuk',
        'status_barang',
        'tanggal_selesai',
        'harga_pengerjaan',
        )->leftJoin('pengambilan_barangs','barangs.id','=','pengambilan_barangs.id_barang')
        ->where('users.id',$id)
        ->where('status_barang','Selesai')
        ->whereNull('id_pengambilan')
        ->orWhere('status_barang','Tidak bisa dikerjakan')
        ->orderBy('barangs.id','DESC')->get();
        return $barangs;
    }
}
