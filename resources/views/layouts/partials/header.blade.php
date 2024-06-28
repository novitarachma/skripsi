<div class="container d-print-none ">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        @if ( auth()->user()->jabatan_id == '1')
                        <li>
                            <li class="active"><a href="{{ route('superadmin.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                            <li>
                                <a href="javascript:void(0)"><i class="ti-dashboard"></i><span>Master Data</span></a>
                                <ul class="submenu">
                                    {{-- <li><a href="{{ route('superadmin.hakakses.index')}}"><i class="ti-user"></i> <span>Staff</span></a></li> --}}
                                    <li><a href="{{ route('superadmin.jabatan.index')}}"><i class="ti-medall"></i> <span>Jabatan</span></a></li>
                                    <li><a href="{{ route('superadmin.karyawan.index')}}"><i class="ti-stamp"></i> <span>Staff</span></a></li>
                                </ul>
                            </li>   
                            <li><a href="{{ route('superadmin.suratmasuk.index')}}"><i class="ti-share"></i> <span>Surat Masuk</span></a></li>
                            <!-- <li><a href="{{ route('superadmin.suratkeluar.index')}}"><i class="ti-share-alt"></i> <span>Surat Keluar</span></a></li> -->
                            <li><a href="{{ route('superadmin.historisurat.index')}}"><i class="ti-archive"></i> <span>Histori Surat Masuk</span></a></li>
                            <!-- <li><a href="{{ route('superadmin.historisuratkeluar.index')}}"><i class="ti-archive"></i> <span>Histori Surat Keluar</span></a></li> -->
                        </li>      
            
                        @endif
                        @if ( auth()->user()->jabatan_id == '2')
                            <li class="active"><a href="{{ route('admin1.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{ route('admin1.suratmasukadmin1.index')}}"><i class="ti-share"></i> <span>Surat Masuk</span></a></li>
                            <!-- <li><a href="{{ route('admin1.suratkeluaradmin1.index')}}"><i class="ti-share-alt"></i> <span>Surat Keluar</span></a></li> -->
                            <li><a href="{{ route('admin1.historisuratadmin1.index')}}"><i class="ti-archive"></i> <span>Histori Surat Masuk</span></a></li>
                            <!-- <li><a href="{{ route('admin1.historisuratkeluaradmin1.index')}}"><i class="ti-archive"></i> <span>Histori Surat Keluar</span></a></li> -->
                            <li><a href="{{ route('admin1.disposisisayaadmin1.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '3')
                        <li class="active"><a href="{{ route('admin2.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <!-- <li><a href="{{ route('admin2.suratmasukadmin2.index')}}"><i class="ti-share"></i> <span>Surat Masuk</span></a></li> -->
                        <!-- <li><a href="{{ route('admin2.suratkeluaradmin2.index')}}"><i class="ti-share-alt"></i> <span>Surat Keluar</span></a></li> -->
                        <li><a href="{{ route('admin2.historisuratadmin2.index')}}"><i class="ti-archive"></i> <span>Histori Surat Masuk</span></a></li>
                        <!-- <li><a href="{{ route('admin2.historisuratkeluaradmin2.index')}}"><i class="ti-archive"></i> <span>Histori Surat Keluar</span></a></li> -->
                        <li><a href="{{ route('admin2.disposisisayaadmin2.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '4')
                        <li class="active"><a href="{{ route('admin3.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('admin3.suratmasukadmin3.index')}}"><i class="ti-share"></i> <span>Surat Masuk</span></a></li>
                        <li><a href="{{ route('admin3.suratkeluaradmin3.index')}}"><i class="ti-share-alt"></i> <span>Surat Keluar</span></a></li>
                        <li><a href="{{ route('admin3.historisuratadmin3.index')}}"><i class="ti-archive"></i> <span>Histori Surat Masuk</span></a></li>
                        <li><a href="{{ route('admin3.historisuratkeluaradmin3.index')}}"><i class="ti-archive"></i> <span>Histori Surat Keluar</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '5')
                        <li class="active"><a href="{{ route('user1.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user1.historisuratuser1.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user1.disposisisayauser1.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '6')
                        <li class="active"><a href="{{ route('user2.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user2.suratmasukuser2.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user2.disposisisayauser2.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '7')
                        <li class="active"><a href="{{ route('user3.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user3.suratmasukuser3.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user3.disposisisayauser3.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '8')
                        <li class="active"><a href="{{ route('user4.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user4.suratmasukuser4.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user4.disposisisayauser4.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '9')
                        <li class="active"><a href="{{ route('user5.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user5.suratmasukuser5.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user5.disposisisayauser5.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '10')
                        <li class="active"><a href="{{ route('user6.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user6.suratmasukuser6.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user6.disposisisayauser6.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '11')
                        <li class="active"><a href="{{ route('user7.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user7.suratmasukuser7.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user7.disposisisayauser7.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '12')
                        <li class="active"><a href="{{ route('user8.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user8.suratmasukuser8.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user8.disposisisayauser8.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '13')
                        <li class="active"><a href="{{ route('user9.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user9.suratmasukuser9.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user9.disposisisayauser9.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '14')
                        <li class="active"><a href="{{ route('user10.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user10.suratmasukuser10.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user10.disposisisayauser10.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '15')
                        <li class="active"><a href="{{ route('user11.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user11.suratmasukuser11.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        <li><a href="{{ route('user11.disposisisayauser11.index')}}"><i class="ti-bell"></i> <span>Disposisi Saya</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '16')
                        <li class="active"><a href="{{ route('user12.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user12.suratmasukuser12.index')}}"><i class="ti-agenda"></i> <span>Histori Surat</span></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- mobile_menu -->
        <div class="col-12 d-block d-lg-none">
            <div id="mobile_menu"></div>
        </div>
    </div>
</div>
<!-- header area end -->