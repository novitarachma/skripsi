@extends('layouts.default')

@section('css')
@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row text-center">
                                    <div class="iv-left col-12">
                                    <span>PT JASAMARGA PANDAAN TOL</span>
                                        <br>
                                        <p>Kali Tengah, Karang Jati, Kec. Pandaan, Pasuruan, Jawa Timur 67156</p>
                                        <br>
                                        <h6><b>DISPOSISI SURAT MASUK PT JASAMARGA PANDAAN TOL</b></h6>
                                        <br>
                                        <h6><b>SURAT KELUAR</b></h6>
                                        <p><b>NO : {{ $surat->no_surat }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-area mt-2">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>Perihal</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->perihal }}</strong>  </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ date('d-m-Y', strtotime($surat->tanggal_surat)) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tujuan Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->tujuan_surat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tipe Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->tipe_surat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->deskripsi }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->status == 'diajukan')
                                                    <span class="badge badge-primary">{{ $surat->status }}</span>
                                                    @else
                                                    <span class="badge badge-success">{{ $surat->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-5 col-12 mb-3">
                            </div>
                            <div class="col-md-4">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td>Lampiran</td>
                                        <td>:</td>
                                        <td>
                                            @if ($surat->lampiran == null)
                                                <span class="badge badge-warning">Tidak Ada Lampiran</span>
                                            @else
                                                <a href="{{ url('lampiran/'.$surat->lampiran) }}" target="_blank">
                                                    <img src="{{ url('lampiran/'.$surat->lampiran) }}" alt="" width="100px">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            
                        </div>
                        <div class="invoice-buttons text-right d-print-none">
                            <a href="#" onclick="window.print();" class="invoice-btn"><i class="ti-printer"></i> Print</a>
                            <a href="{{ route('admin2.historisuratkeluaradmin2.index')}}" class="invoice-btn"><i class="ti-back-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection