<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = Karyawan::with(['jabatan_bidang','user','jabatan'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('h_tanggal', function ($row) {
                    if ($row->user) {
                        $tanggal = date('d-m-Y H:i:s', strtotime($row->user->created_at));
                        return $tanggal;
                    } else {
                        return null; // Atau pesan lain yang sesuai dengan kasus Anda
                    }
                })

                ->addColumn('jabatan', function ($row) {
                   return !empty($row->jabatan_bidang->nama_jabatan_bidang) ? $row->jabatan_bidang->nama_jabatan_bidang : '-';
                })
                ->addColumn('nama_role', function ($row) {
                    return !empty($row->jabatan->nama_role) ? $row->jabatan->nama_role : '-';
                 })

                
                ->addColumn('action', function ($row) {
                    $username = $row->nama ? $row->nama : ''; // Periksa apakah $row->user ada sebelum mengakses properti 'name'
                    $actionBtn = '
                            <center>
                            <a href="https://api.whatsapp.com/send/?phone='. $row->no_wa .'&text=*Berikut Akun Hak Akses Anda* :
                %0A
                Username : '. $username .'%0A
                Password : admindev%0A
                %0A
                *Silahkan Melakukan Akses Sistem dengan Klik Link berikut ini *
                            " target="_blank" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Kirim WA"><i class="ti-announcement"></i>  Kirim WA</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_tanggal','jabatan','nama_role'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();

        return view('superadmin.karyawan.index', [
            'title'     => 'Staff',
            'jabatan'   => $jabatan
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
            'nama'                => 'required',
            'no_wa'               => 'required',
            'jabatan_bidang_id'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            Karyawan::find($request->id)->update(
                [
                    'nama'                     => $request->nama,
                    'no_wa'                    => $request->no_wa,
                    'jabatan_bidang_id'        => $request->jabatan_bidang_id,
                ]
            );
        } else {

            Karyawan::Create(
                [
                    'nama'                     => $request->nama,
                    'no_wa'                    => $request->no_wa,
                    'jabatan_bidang_id'        => $request->jabatan_bidang_id,
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
        $data = Karyawan::find($id);
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
        $data = Karyawan::find($id);
        $data->delete();
        return response()->json(['status' => true]);
    }
}
