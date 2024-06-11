<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
            'no_urut',
            'dari_instansi',
            'no_surat',
            'perihal',
            'tanggal_surat',
            'tanggal_terima',
            'kepada',
            'kategori_surat',
            'isi_disposisi',
            'status',
            'lampiran',
            'tindakan',
            'jabatan_bidang_id',
            'karyawan_id',
            'tindakan_kadin',
            'catatan_kadin',
            'tanggal_penyelesaian',
            'tanggal_konfirmasi_admin1',
            'tanggal_konfirmasi_admin2',
            'tanggal_konfirmasi_admin3',
            'catatan',
            'klasifikasi',
    ];

    public static function generateNoUrut()
    {
        $latestSurat = static::latest()->first(); // Get the latest record
        if ($latestSurat) {
            $latestNoUrut = $latestSurat->no_urut;
            // Extract numeric part and increment
            $noUrut = intval(substr($latestNoUrut, 0, 3)) + 1;
        } else {
            $noUrut = 1; // If there's no existing record, start from 1
        }
        // Format the new no_urut with leading zeros
        return str_pad($noUrut, 3, '0', STR_PAD_LEFT);
    }


    public function jabatan_bidang()
    {
        return $this->belongsTo(JabatanBidang::class, 'jabatan_bidang_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
    
}
