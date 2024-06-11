<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HistoriSuratKeluarController extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratKeluar::where('status', 'selesai')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                //status
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diajukan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-primary">Menunggu</a>';
                    }
                    if ($data->status == 'ditolak') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Dilaksanakan</a>';
                    }
                    if ($data->status == 'diverifikasi-kasubag') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasub</a>';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-secondary">Diverifikasi Sekdin</a>';
                    }
                    if ($data->status == 'selesai') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>';
                    }
                    return $status;
                })
                ->addColumn('h_tanggal_terima', function ($data) {
                    $tanggal_terima = date('d-m-Y', strtotime($data->tanggal_terima));
                    return $tanggal_terima;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <center>
                            <a href="histori-suratkeluar/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"> Detail</i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status', 'h_tanggal_terima'])
                ->make(true);
        }


        return view('superadmin.historisuratkeluar.index', [
            'title'     => 'Histori Surat Keluar'
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratKeluar::where('id', $kode)->first();

        return view('superadmin.historisuratkeluar.detail', [
            'title' => 'Detail Histori Surat',
            'surat' => $surat
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SuratKeluar::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
