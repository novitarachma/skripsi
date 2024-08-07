<?php

namespace App\Http\Controllers\Admin1;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class SuratMasukAdmin1Controller extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratMasuk::with('jabatan_bidang')
            ->where('status','diajukan')
            ->orWhere('status','didisposisi')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                //status
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diajukan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Menunggu</a>';
                    }
                    if ($data->status == 'didisposisi') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Disposisi</a>';
                    }
                    if ($data->status == 'dilaksanakan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-primary">Dilaksanakan</a>';
                    }
                    if ($data->status == 'diverifikasi-kasubag') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasubag</a>';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Diverifikasi Sekdin</a>';
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

                    if ($data->kategori_surat == 'penting') {
                        $kategori_surat     = '<a href="javascript:void(0)" class="badge badge-primary">Penting</a>';
                    }
                    return $kategori_surat;
                })
                //h_tanggal_terima
                ->addColumn('h_tanggal_terima', function ($data) {
                    $tanggal_terima = date('d-m-Y', strtotime($data->tanggal_terima));
                    return $tanggal_terima;
                })
                // ->addColumn('action', function ($row) {
                //     $actionBtn = '
                //             <center>
                //             <a href="surat-masukadmin1/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>

                //             <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi" onclick="edit(' . $row->id . ')"><i class="ti-check"></i> Konfirmasi</a>
                //             <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi" onclick="edit(' . $row->id . ')"><i class="ti-check"></i> Kirim Wa</a>
                            
                //             <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                //             </center>';
                //     return $actionBtn;
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<center>';
                
                    if ($row->status == 'diajukan') {
                        $actionBtn .= '<a href="surat-masukadmin1/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>';
                        
                        $actionBtn .= '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi" onclick="edit(' . $row->id . ')"><i class="ti-check"></i> Konfirmasi</a>';
                    } elseif ($row->status == 'didisposisi') {
                        $dataKaryawan = Karyawan::find($row->karyawan_id);
                        $username = $dataKaryawan->nama ? $dataKaryawan->nama : '';
                        $actionBtn .= '<a href="surat-masukadmin1/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>';
                        
                        $actionBtn .= '    <a href="https://api.whatsapp.com/send/?phone='. $dataKaryawan->no_wa .'&text=*Silahkan segera login ke website disposisi surat masuk untuk melakukan tindakan pada surat masuk*
                                    " target="_blank" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Kirim WA"><i class="ti-announcement"></i>  Kirim WA</a>';
                    }
                
                    $actionBtn .= '<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>';
                    
                    $actionBtn .= '</center>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status','h_kategori_surat', 'h_tanggal_terima'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();
        // $dataKaryawan = Karyawan::with(['jabatan_bidang','user','jabatan'])
        // ->whereNotNull('jabatan_bidang_id')
        // ->where('jabatan_bidang_id','!=',1)
        // ->get();
        $dataKaryawan = Role::with('karyawan')
        ->whereNotIn('id',[1,2])->get();
        // dd($dataKaryawan);
        // foreach ($dataKaryawan as $key => $item) {
        //     dd($item->jabatan['bagian']);
        // }
        // dd($jabatan);
        return view('admin1.suratmasuk.index', [
            'title'     => 'Surat Masuk',
            'jabatan'   => $jabatan,
            'dataKaryawan'   => $dataKaryawan,
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratMasuk::where('id', $kode)->first();

        return view('admin1.suratmasuk.detail', [
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
            'tindakan'       => 'required',
        ]);
    //    dd($validator);
        $kepada = explode(" - ",$request->kepada);
        // dd($kepada);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            //if request tindakan diajukan 
            // if ($request->tindakan == 'diajukan') {
                SuratMasuk::find($request->id)->update(
                    [
                        'tindakan'                    => $request->tindakan,
                        'karyawan_id'                    => $kepada[0],
                        'jabatan_bidang_id'                    => $kepada[1],
                        'status'                      => 'didisposisi',
                        'tanggal_konfirmasi_admin1'   => date('Y-m-d H:i:s'),
                        'catatan'                      =>$request->catatan,
                    ]
                );
            // }else{
            //     SuratMasuk::find($request->id)->update(
            //         [
            //             'tindakan'                    => $request->tindakan,
            //             'status'                      => 'didisposisi',
            //             'catatan'                      =>$request->catatan,

            //         ]
            //     );
            // }

            
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
                    // 'status'                      => 'didisposisi',
                    'catatan'                      =>$request->catatan,
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
