<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    protected $table = 'm_barang';        
    protected $primaryKey = 'barang_id'; 

    protected $fillable = ['barang_kode', 'barang_nama'];

    public function barang():BelongsTo {
        return $this->belongsTo(KategoriModel::class);
    }

    public function supplier():BelongsTo {
        return $this->belongsTo(SupplierModel::class);
    }
}

?>