<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratMasukController extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratMasuk::with('jabatan_bidang')
            ->whereIn('status', ['diajukan', 'didisposisi', 'dilaksanakan', 'diverifikasi-kasubag', 'diverifikasi-sekdin','ditolak'])
            ->orderByRaw("FIELD(kategori_surat, 'sangat-segera', 'segera', 'biasa')")
            ->orderBy('tanggal_terima', 'desc')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                //status
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diverifikasi-sekdin') {
                        if($data->tanggal_konfirmasi_admin3 == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverifikasi Sekdin</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverifikasi Sekdin</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->tanggal_konfirmasi_admin2)) . '
                            ';
                        }
                    }
                    if ($data->status == 'diajukan') {
                        if($data->created_at == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-primary">Menunggu</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-primary">Menunggu</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->created_at)) . '
                            ';
                        }
                    }
                    if ($data->status == 'didisposisi') {
                        if($data->tanggal_konfirmasi_admin3 == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-info">Disposisi</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-info">Disposisi</a>
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
                        if($data->tanggal_konfirmasi_admin1 == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-info">Diverfikasi Kasub</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-info">Diverfikasi Kasub</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->tanggal_konfirmasi_admin1)) . '
                            ';
                        }
                    }
                    if ($data->status == 'selesai') {
                        if($data->tanggal_penyelesaian == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->tanggal_penyelesaian)) . '
                            ';
                        }
                    }
                    if ($data->status == 'ditolak') {
                        if($data->tanggal_penyelesaian == null){
                            $status     = '<a href="javascript:void(0)" class="badge badge-danger">Ditolak</a>';
                        }else{
                            $status     = '<a href="javascript:void(0)" class="badge badge-danger">Ditolak</a>
                            <br>
                            '
                            . date('d-m-Y', strtotime($data->tanggal_penyelesaian)) . '
                            ';
                        }
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
                ->addColumn('action', function ($row) {
                    if($row->status == 'ditolak'){
                        $actionBtn = '
                        <center>
                        <a href="surat-masuk/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                        <br>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Ajukan Kembali" onclick="edit_ditolak(' . $row->id . ')"> Ajukan Kembali <i class="ti-arrow-circle-right"></i></a>
                        </center>';
                    }else{
                        $actionBtn = '
                        <center>
                        <a href="surat-masuk/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                        </center>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status','h_kategori_surat','h_tanggal_terima'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();
        $newNoUrut = SuratMasuk::generateNoUrut();
        // dd($newNoUrut);die;
        return view('superadmin.suratmasuk.index', [
            'title'     => 'Surat Masuk',
            'jabatan'   => $jabatan,
            'newNoUrut'   => $newNoUrut,
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratMasuk::where('id', $kode)->first();

        return view('superadmin.suratmasuk.detail', [
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
            'no_urut'        => 'required',
            'dari_instansi'  => 'required',
            'no_surat'       => 'required',
            'perihal'        => 'required',
            'tanggal_surat'  => 'required',
            'tanggal_terima' => 'required',
            'kategori_surat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

          //upload file
          if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $file_name = time()."_".$file->getClientOriginalName();
            $file->move('lampiran',$file_name);
        }else{
            $file_name = null;
        }
        // dd($request->klasifikasi    );
        if ($request->id) {

            SuratMasuk::find($request->id)->update(
                [
                    'no_urut'                     => $request->no_urut,
                    'dari_instansi'               => $request->dari_instansi,
                    'no_surat'                    => $request->no_surat,
                    'perihal'                     => $request->perihal,
                    'tanggal_surat'               => $request->tanggal_surat,
                    'tanggal_terima'              => $request->tanggal_terima,
                    'kepada'                      => 'Direktur keuangan & umum',
                    'kategori_surat'              => $request->kategori_surat,
                    'klasifikasi'                 => $request->klasifikasi,
                    'lampiran'                    => $file_name
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
                    'kepada'                      => 'Direktur keuangan & umum',
                    'kategori_surat'              => $request->kategori_surat,
                    'klasifikasi'              => $request->klasifikasi,
                    'status'                      => 'diajukan',
                    'lampiran'                    => $file_name,
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

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'      => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        if ($request->id) {

            SuratMasuk::find($request->id)->update(
                [
                    'status'                      => $request->status,
                ]
            );
        } else {

            SuratMasuk::Create(
                [
                    'status'                      => 'diajukan',
                ]
            );
        }
                return response()->json(['status' => true]);
    
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
