<?php

namespace App\Http\Controllers\Admin3;

use App\Models\Karyawan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratMasukAdmin3Controller extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratMasuk::with('jabatan_bidang')
            ->whereIN('status',['didisposisi','dilaksanakan','diverifikasi-sekdin'])
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                //status
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diajukan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Menunggu</a>';
                    }
                    
                    if ($data->status == 'didisposisi') {
                        //if data tanggal konfirmasi admin 3 kosong
                        if($data->tanggal_konfirmasi_admin3 == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-warning">Disposisi</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-warning">Disposisi</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->tanggal_konfirmasi_admin3)) . '
                            ';
                        }
                    }
                    if ($data->status == 'dilaksanakan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-primary">Dilaksanakan</a>';
                    }
                    if ($data->status == 'diverifikasi-kasubag') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasubag</a>';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Diverifikasi Sekdin</a>
                        <br>
                        ' . date('d-m-Y', strtotime($data->tanggal_konfirmasi_admin3)) . '
                        ';
                    }
                    if ($data->status == 'selesai') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>';
                    }
                    return $status;
                })
                 //h_kategori_surat
                 ->addColumn('h_kategori_surat', function ($data) {
                    if ($data->kategori_surat == 'segera') {
                        $kategori_surat     = '<a href="javascript:void(0)" class="badge badge-warning">Segera</a>';
                    }
                    if ($data->kategori_surat == 'sangat-segera') {
                        $kategori_surat     = '<a href="javascript:void(0)" class="badge badge-danger">Sangat Segera</a>';
                    }
                    if ($data->kategori_surat == 'biasa') {
                        $kategori_surat     = '<a href="javascript:void(0)" class="badge badge-primary">Biasa</a>';
                    }
                    return $kategori_surat;
                })
                //h_tanggal_terima
                ->addColumn('h_tanggal_terima', function ($data) {
                    $tanggal_terima = date('d-m-Y', strtotime($data->tanggal_terima));
                    return $tanggal_terima;
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 'didisposisi'){
                        $actionBtn = '
                            <center>
                            <a href="https://api.whatsapp.com/send/?phone='. $row->karyawan->no_wa .'&text=*Selamat Anda Mendapatkan Tugas Disposisi Surat* :
%0ANo : '. $row->no_surat.'%0A
Dari : '. $row->dari_instansi .'%0A
Tanggal Surat : '. date('d-m-Y', strtotime($row->tanggal_surat)) .'%0A
Tanggal Terima : '. date('d-m-Y', strtotime($row->tanggal_terima)) .'%0A
Perihal : '. $row->perihal .'%0A
Kategori Surat : '. $row->kategori_surat .'%0A
%0A
Isi Disposisi : '. $row->isi_disposisi .'%0A
Diteruskan Kepada : '. $row->jabatan_bidang->nama_jabatan_bidang .'%0A
Tanggal Diteruskan : '. date('d-m-Y', strtotime($row->created_at)) .'%0A
Disposisikan Kepada : '. $row->karyawan->nama .'%0A
Tindakan : '. $row->tindakan_kadin .'%0A
Catatan Kadin : '. $row->catatan_kadin .'%0A
%0A
*Silahkan Melakukan Konfirmasi dengan Klik Link ini http://disporarchive.com dan pilih Menu Disposisi Saya di Aplikasi Untuk Melihat Detail Surat*
                            " target="_blank" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Kirim WA"><i class="ti-announcement"></i>  Kirim WA</a>
                            <a href="histori-suratadmin3/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"> Detail</i></a>
                            </center>';
                    }else{
                        $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi" onclick="edit(' . $row->id . ')"><i class="ti-check"> Konfirmasi</i></a>
                            </center>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status', 'h_kategori_surat', 'h_tanggal_terima'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();
        $karyawan = Karyawan::select('id', 'nama')->get();

        return view('admin3.suratmasuk.index', [
                'title'     => 'Surat Masuk',
                'jabatan'   => $jabatan,
                'karyawan'  => $karyawan
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratMasuk::where('id', $kode)->first();

        return view('admin3.suratmasuk.detail', [
            'title' => 'Detail Surat Masuk',
            'surat' => $surat
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_disposisi'       => 'required',
            'jabatan_bidang_id'   => 'required',
            'karyawan_id'         => 'required',
            'tindakan_kadin'      => 'required',
            'catatan_kadin'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'didisposisi',
                        'isi_disposisi'               => $request->isi_disposisi,
                        'jabatan_bidang_id'           => $request->jabatan_bidang_id,
                        'karyawan_id'                 => $request->karyawan_id,
                        'tindakan_kadin'              => $request->tindakan_kadin,
                        'catatan_kadin'               => $request->catatan_kadin,
                        'tanggal_penyelesaian'        => date('Y-m-d H:i:s'),
                        'tanggal_konfirmasi_admin3'   => date('Y-m-d H:i:s'),
                    ]
                );

        } else {

            SuratMasuk::Create(
                [
                    'no_urut'                     => $request->no_urut,
                    'dari_instansi'               => $request->dari_instansi,
                    'no_surat'                    => $request->no_surat,
                    'perihal'                     => $request->perihal,
                    'tanggal_surat'               => $request->tanggal_surat,
                    'tanggal_terima'              => $request->tanggal_terima,
                    'kepada'                      => $request->kepada,
                    'kategori_surat'              => $request->kategori_surat,
                    'status'                      => 'diajukan',
                    'lampiran'                    => $request->lampiran,
                ]
            );
        }

        return response()->json(['status' => true]);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SuratMasuk::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SuratMasuk::find($id);
        $data->delete();
        return response()->json(['status' => true]);
    }
}
