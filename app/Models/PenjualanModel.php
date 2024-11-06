<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;


class PenjualanModel extends Model implements JWTSubject

{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $table = 't_penjualan';        
    protected $primaryKey = 'penjualan_id'; 

    protected $fillable = ['user_id', 'barang_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal', 'image'];


    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }

    protected function image(): Attribute{
        return Attribute::make(
            get: fn ($image) => url('/gambar/' . $image),
        );
    }

}

?>