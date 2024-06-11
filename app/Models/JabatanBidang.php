<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanBidang extends Model
{
    use HasFactory;

    protected $table = 'jabatan_bidang';

    protected $fillable = [
        'nama_jabatan_bidang',
        'divisi'
    ];

    // SEMENTARA
    public function surat_masuk(){
        return $this->hasMany(SuratMasuk::class);
    }
}
