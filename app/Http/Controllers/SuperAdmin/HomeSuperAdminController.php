<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class HomeSuperAdminController extends Controller
{
    public function index(Request $request)
    {
        $total_surat_masuk          = $this->total_surat_masuk();
        $total_surat_keluar         = $this->total_surat_keluar();
        $total_surat_diproses       = $this->total_surat_diproses();
        $total_surat_selesai        = $this->total_surat_selesai();

        return view('superadmin.dashboard', [
            'title'                 => 'Dashboard',
            'total_surat_masuk'     => $total_surat_masuk,
            'total_surat_keluar'    => $total_surat_keluar,
            'total_surat_diproses'  => $total_surat_diproses,
            'total_surat_selesai'   => $total_surat_selesai,
        ]);
    }

    public function show(Request $request, $id)
    {
        $total_surat_masuk = SuratMasuk::where('tanggal_surat', '>=', $request->get('awal'))
            ->where('tanggal_surat', '<=', $request->get('akhir'))
            ->count();

        $total_surat_keluar = SuratKeluar::where('tanggal_surat', '>=', $request->get('awal'))
            ->where('tanggal_surat', '<=', $request->get('akhir'))
            ->count();

        $total_surat_diproses = SuratMasuk::where('tanggal_surat', '>=', $request->get('awal'))
            ->where('tanggal_surat', '<=', $request->get('akhir'))
            ->whereIn('status', ['diajukan', 'didisposisi', 'dilaksanakan', 'diverifikasi-kasubag', 'diverifikasi-sekdin'])
            ->count();

        $total_surat_selesai = SuratMasuk::where('tanggal_surat', '>=', $request->get('awal'))
            ->where('tanggal_surat', '<=', $request->get('akhir'))
            ->where('status', '=', 'selesai')
            ->count();

        $array = array(
            'total_surat_masuk'     => $total_surat_masuk,
            'total_surat_keluar'    => $total_surat_keluar,
            'total_surat_diproses'  => $total_surat_diproses,
            'total_surat_selesai'   => $total_surat_selesai,

        );

        return response()->json($array);
    }


    function total_surat_masuk(){
        $surat_masuk = DB::table('surat_masuk')
        ->count();
        
        if($surat_masuk){
            return $surat_masuk;
        }else{
            return 0;
        }
    }

    function total_surat_keluar(){
        $surat_keluar = DB::table('surat_keluar')
        ->count();
        
        if($surat_keluar){
            return $surat_keluar;
        }else{
            return 0;
        }
    }

    function total_surat_diproses(){
        $surat_diproses = DB::table('surat_masuk')
        ->whereIn('status', ['diajukan', 'didisposisi', 'dilaksanakan', 'diverifikasi-kasubag', 'diverifikasi-sekdin'])
        ->count();
        
        if($surat_diproses){
            return $surat_diproses;
        }else{
            return 0;
        }
    }

    function total_surat_selesai(){
        $surat_selesai = DB::table('surat_masuk')
        ->where('status', '=', 'selesai')
        ->count();
        
        if($surat_selesai){
            return $surat_selesai;
        }else{
            return 0;
        }
    }
}
