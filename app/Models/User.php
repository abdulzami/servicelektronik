<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'level',
        'nama',
        'jk',
        'no_hp',
        'no_wa',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    static function Konsumen() {
        $konsumens = User::where('level','konsumen')->orderBy('id', 'DESC')->get();
        return $konsumens;
    }

    static function Konsumenid($id) {
        $konsumenid = User::where('id',$id)->first();
        return $konsumenid;
    }
}
