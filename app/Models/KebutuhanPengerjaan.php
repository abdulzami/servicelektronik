<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class KebutuhanPengerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kebutuhan',
        'biaya',
        'id_barang',
    ];

    static function Kebutuhanpengerjaan($id)
    {
        $kepengs = KebutuhanPengerjaan::join('barangs', 'kebutuhan_pengerjaans.id_barang', '=', 'barangs.id')
            ->select('nama_kebutuhan',
            'biaya',
            'id_barang','kebutuhan_pengerjaans.id as id_kepeng')
            ->where('kebutuhan_pengerjaans.id_barang',$id)
            ->orderBy('kebutuhan_pengerjaans.id', 'DESC')->get();
        return $kepengs;
    }

    static function Kebutuhanpengerjaansum($id)
    {
        $price = DB::table('kebutuhan_pengerjaans')
                ->where('kebutuhan_pengerjaans.id_barang', $id)
                ->sum('biaya');
        return $price;
    }

    static function Kebutuhanpengerjaan2($id)
    {
        $kepengs = KebutuhanPengerjaan::join('barangs', 'kebutuhan_pengerjaans.id_barang', '=', 'barangs.id')
            ->where('id_barang',$id)
            ->select('nama')
            ->first();
            
        return $kepengs;
    }

    static function Kebutuhanpengerjaanid($id)
    {
        $kepengs = KebutuhanPengerjaan::where('id',$id)->first();
        return $kepengs;
    }
}
