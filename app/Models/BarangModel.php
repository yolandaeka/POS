<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BarangModel extends Model implements JWTSubject

{
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasFactory;

    protected $table = 'm_barang';        
    protected $primaryKey = 'barang_id'; 

    protected $fillable = ['barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id', 'image'];

    public function kategori():BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
 
    public function supplier():BelongsTo {
        return $this->belongsTo(SupplierModel::class);
    }

    protected function image(): Attribute{
        return Attribute::make(
            get: fn ($image) => url('/gambar/' . $image),
        );
    }



}

?>