<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama',
        'no_wa',
        'jabatan_bidang_id'
    ];

    public function jabatan_bidang()
    {
        return $this->belongsTo(JabatanBidang::class);
    }

    //user jabatan_id
    public function user()
    {
        return $this->hasOne(User::class, 'jabatan_id');
    }

    //role jabatan_id
    public function jabatan()
    {
        return $this->belongsTo(Role::class, 'id');
    }
}
