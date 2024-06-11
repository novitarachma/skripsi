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
                                        <span>PEMERINTAH KOTA SURAKARTA</span>
                                        <br>
                                        <span>DINAS KEPEMUDAAN DAN OLAHRAGA</span>
                                        <br>
                                        <p>Jl. Adisucipto No. 1 Manahan Surakarta (0271) 742207 Pswt: Fax (0271) 729101 SURAKARTA 57139</p>
                                        <br>
                                        <h6><b>DISPOSISI KEPALA DINAS KEPEMUDAAN DAN OLAHRAGA</b></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-area mt-2">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>Dari</td>
                                                <td>:</td>
                                                <td>{{ $surat->dari_instansi }}</td>
                                            </tr>
                                            <tr>
                                                <td>No Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->no_surat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ date('d-m-Y', strtotime($surat->tanggal_surat)) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Diterima Tanggal</td>
                                                <td>:</td>
                                                <td><strong>{{ date('d-m-Y', strtotime($surat->tanggal_terima)) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>No Agenda</td>
                                                <td>:</td>
                                                <td>{{ $surat->no_urut }}</td>
                                            </tr>
                                            <tr>
                                                <td>Perihal</td>
                                                <td>:</td>
                                                <td>{{ $surat->perihal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kategori Surat</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->kategori_surat == 'Segera')
                                                    <span class="badge badge-primary">{{ $surat->kategori_surat }}</span>
                                                    @else
                                                    <span class="badge badge-danger">{{ $surat->kategori_surat }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Isi Disposisi</td>
                                                <td>:</td>
                                                <td>{{ $surat->isi_disposisi }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->status == 'diajukan')
                                                    <span class="badge badge-success">{{ $surat->status }}</span>
                                                    @else
                                                    <span class="badge badge-warning">{{ $surat->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diteruskan Kepada</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->jabatan_bidang == null)
                                                    <span class="badge badge-danger">Belum Diteruskan</span>
                                                    @else
                                                    {{ $surat->jabatan_bidang->nama_jabatan_bidang }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>:</td>
                                                <td><strong>{{ date('d-m-Y', strtotime($surat->tanggal_terima)) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Disposisikan Kepada</td>
                                                <td>:</td>
                                                <td>
                                                    @if($surat->karyawan == null)
                                                    <span class="badge badge-danger">Belum Disposisikan</span>
                                                    @else
                                                    {{ $surat->karyawan->nama }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tindakan</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->tindakan_kadin == null)
                                                    <span>-</span>
                                                    @else
                                                    {{ $surat->tindakan_kadin }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Catatan Kadin</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->catatan_kadin == null)
                                                    <span>-</span>
                                                    @else
                                                    {{ $surat->catatan_kadin }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Penyelesaian</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($surat->tanggal_penyelesaian == null)
                                                    <span>-</span>
                                                    @else
                                                    <strong>{{ date('d-m-Y h:i:s', strtotime($surat->tanggal_penyelesaian)) }}</strong></td>
                                                    @endif
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                                <hr>
                                <div class="col-md-5">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td>Lampiran</td>
                                            <td>:</td>
                                            <td>
                                                <a href="{{ url('lampiran/'.$surat->lampiran) }}"
                                                    target="_blank">
                                                    <img src="{{ url('lampiran/'.$surat->lampiran) }}"
                                                        alt="" width="100px">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right d-print-none">
                            <a href="#" onclick="window.print();" class="invoice-btn"><i class="ti-printer"></i> Print</a>
                            <a href="{{ route('admin2.historisuratadmin2.index')}}" class="invoice-btn"><i class="ti-back-left"></i> Kembali</a>
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