<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PenjualanDetailModel extends Model

{
    
    protected $table = 't_penjualan_detail';        
    protected $primaryKey = 'penjualan_id'; 

    protected $fillable = ['penjualan_id','barang_id', 'harga', 'jumlah'];


    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'user_id');
    }

}

?>