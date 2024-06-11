@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ url('srtdash/assets/css/bootstrap.min.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <h2 class="header-title">Filter Data Surat</h2>
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label>Tanggal Awal</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-01')}}" id="awal">
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control" 
                                    value="{{ date('Y-m-d')}}"
                                    id="akhir">
                                </div>
                                <div class="col-md-1 col-12 text-center mt-3">
                                    <button onclick="add_filter()" class="btn btn-secondary mt-3"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- data table end -->
            </div>
            <div class="row">
                <!-- seo fact area start -->    
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 mt-5 mb-3">
                            <div class="card">
                                <div class="seo-fact sbg1">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-bar-chart-alt"></i> Total Surat Masuk</div>
                                        <h2><span id="total_surat_masuk">0</span></h2>
                                    </div>
                                    <a href="{{ url('superadmin/suratmasuk') }}" class="btn btn-primary"
                                    style="background-color: #edf1f1; border-color: #edf1f1; color: black; border-radius: 5px; margin-left: 10px; margin-bottom: 10px; margin-top: 10px; width: 120px;"
                                    >Lihat Detail   <i class="ti-arrow-circle-right"></i></a>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-md-5 mb-3">
                        <div class="card">
                                <div class="seo-fact sbg4">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-share"></i> Total Surat Selesai</div>
                                        <h2><span id="total_surat_selesai">0</span></h2>
                                    </div>
                                    <a href="{{ url('superadmin/historisurat') }}" class="btn btn-primary"
                                    style="background-color: #edf1f1; border-color: #edf1f1; color: black; border-radius: 5px; margin-left: 10px; margin-bottom: 10px; margin-top: 10px; width: 120px;"
                                    >Lihat Detail   <i class="ti-arrow-circle-right"></i></a>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="seo-fact sbg2">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-briefcase"></i> Total Surat Keluar</div>
                                        <h2><span id="total_surat_keluar">0</span></h2>
                                    </div>
                                    <a href="{{ url('superadmin/suratkeluar') }}" class="btn btn-primary"
                                    style="background-color: #edf1f1; border-color: #edf1f1; color: black; border-radius: 5px; margin-left: 10px; margin-bottom: 10px; margin-top: 10px; width: 120px;"
                                    >Lihat Detail   <i class="ti-arrow-circle-right"></i></a>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <div class="card">
                                <div class="seo-fact sbg3">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-share-alt"></i> Total Surat Diproses</div>
                                        <h2><span id="total_surat_diproses">0</span></h2>
                                    </div>
                                    <a href="{{ url('superadmin/suratmasuk') }}" class="btn btn-primary"
                                    style="background-color: #edf1f1; border-color: #edf1f1; color: black; border-radius: 5px; margin-left: 10px; margin-bottom: 10px; margin-top: 10px; width: 120px;"
                                    >Lihat Detail   <i class="ti-arrow-circle-right"></i></a>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="card">
                                <div class="seo-fact sbg4">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-share"></i> Total Surat Selesai</div>
                                        <h2><span id="total_surat_selesai">0</span></h2>
                                    </div>
                                    <a href="{{ url('superadmin/historisurat') }}" class="btn btn-primary"
                                    style="background-color: #edf1f1; border-color: #edf1f1; color: black; border-radius: 5px; margin-left: 10px; margin-bottom: 10px; margin-top: 10px; width: 120px;"
                                    >Lihat Detail   <i class="ti-arrow-circle-right"></i></a>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

    <script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ url('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>
    {{-- <script src="{{ url('srtdash/assets/js/line-chart.js') }}"></script> --}}
    <script src="{{ url('srtdash/assets/js/pie-chart.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/scripts.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      count_total();
      
    });

        function reload_table(){
            table.ajax.reload(null,false);
        }

        function add_filter(){
            var awal        = $("#awal").val();
            var akhir       = $("#akhir").val();
            count_total();
            sukses();
        }

        function count_total(){
            var awal        = $("#awal").val();
            var akhir       = $("#akhir").val();
            //Ajax Load data from ajax
            $.ajax({
            url : "/superadmin/home/1?awal=" + awal + "&&akhir=" + akhir,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

            //    console.log(data.total_surat_masuk);

                if(data.total_surat_masuk){
                $("#total_surat_masuk").text(data.total_surat_masuk);
                }else{
                $("#total_surat_masuk").text(0);
                }

                if(data.total_surat_keluar){
                $("#total_surat_keluar").text(data.total_surat_keluar);
                }else{
                $("#total_surat_keluar").text(0);
                }

                if(data.total_surat_diproses){
                $("#total_surat_diproses").text(data.total_surat_diproses);
                }else{
                $("#total_surat_diproses").text(0);
                }

                if(data.total_surat_selesai){
                $("#total_surat_selesai").text(data.total_surat_selesai);
                }else{
                $("#total_surat_selesai").text(0);
                }


            },
            error: function (jqXHR, textStatus , errorThrown) {
                alert(errorThrown);
            }
            });
        }

        function sukses() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'success',
                title: 'Sukses Filter Data !'
            })
        }


    </script>

@endsection