<?php

namespace App\Http\Controllers\Admin2;

use App\Models\Karyawan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratMasukAdmin2Controller extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratMasuk::with('jabatan_bidang')
            ->where('status','diverifikasi-kasubag')
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
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasubag</a>
                        <br>
                        ' . date('d-m-Y', strtotime($data->tanggal_konfirmasi_admin1)) . '
                        ';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-secondary">Diverifikasi Sekdin</a>';
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
                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Konfirmasi" onclick="edit(' . $row->id . ')"><i class="ti-check"></i> Konfirmasi</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Disposisi" onclick="edit_disposisi(' . $row->id . ')"><i class="ti-check"></i> Disposisi</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status','h_kategori_surat', 'h_tanggal_terima'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();
        $karyawan = Karyawan::select('id', 'nama')->get();

        return view('admin2.suratmasuk.index', [
            'title'     => 'Surat Masuk',
            'jabatan'   => $jabatan,
            'karyawan'  => $karyawan
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratMasuk::with(['jabatan_bidang', 'karyawan'])->where('id', $kode)->first();

        return view('admin2.suratmasuk.detail', [
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            //if request tindakan diajukan 
            if ($request->tindakan == 'diajukan') {
                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'diverifikasi-sekdin',
                        'tanggal_konfirmasi_admin2'   => date('Y-m-d H:i:s'),
                    ]
                );
            }else{
                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'ditolak',
                    ]
                );
            }

            
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

    public function updateDisposisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_disposisi'       => 'required',
            'jabatan_bidang_id'   => 'required',
            'karyawan_id'         => 'required',
            'tindakan_kadin'      => 'required',
            'catatan_kadin'       => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'didisposisi',
                        'isi_disposisi'               => $request->isi_disposisi,
                        'jabatan_bidang_id'           => $request->jabatan_bidang_id,
                        'karyawan_id'                 => $request->karyawan_id,
                        'tindakan_kadin'              => $request->tindakan_kadin,
                        'catatan_kadin'               => $request->catatan_kadin,
                        'tanggal_penyelesaian'        => date('Y-m-d H:i:s'),
                        'tanggal_konfirmasi_admin2'   => date('Y-m-d H:i:s'),
                    ]
                );

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
