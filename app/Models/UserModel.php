<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; //implementasi class Authenticatable

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';    //table yang akan digunakan
    protected $primaryKey = 'user_id'; //primary key dari table

    protected $fillable = ['level_id', 'username', 'nama', 'password', 'created_at', 'updated_at'];

   protected $hidden = ['password']; //jangan ditampilkan saat select

   protected $casts = ['password' => 'hashed'];  //casting password agar otomatis di hash
   
   //relasi ke tabel level
    public function level(): BelongsTo {

        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
