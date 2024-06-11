<?php

namespace App\Http\Controllers\Admin3;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeAdmin3Controller extends Controller
{
    public function index(Request $request)
    {
        $total_surat_belum_terkonfirmasi = $this->total_surat_belum_terkonfirmasi();
        $total_surat_diproses            = $this->total_surat_diproses();

        return view('admin3.dashboard', [
            'title'                               => 'Dashboard',
            'total_surat_belum_terkonfirmasi'     => $total_surat_belum_terkonfirmasi,
            'total_surat_diproses'                => $total_surat_diproses,
        ]);
    }

    //total_surat_belum_terkonfirmasi
    function total_surat_belum_terkonfirmasi(){
        $surat_belum_terkonfirmasi = DB::table('surat_masuk')
        ->where('status',['diverifikasi-sekdin'])
        ->count();
        
        if($surat_belum_terkonfirmasi){
            return $surat_belum_terkonfirmasi;
        }else{
            return 0;
        }
    }


    function total_surat_diproses(){
        $surat_diproses = DB::table('surat_masuk')
        ->where('status', 'selesai')
        ->count();
        
        if($surat_diproses){
            return $surat_diproses;
        }else{
            return 0;
        }
    }
}
