@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('container')
<main>
    <header class="page-header page-header-dark bg-success pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            Dashboard
                        </h1>
                        <div class="page-header-subtitle">Administrator Panel</div>
                        <div class="page-header-subtitle fw-bold text-white text-capitalize">{{auth()->user()->jabatan}}</div>
                    </div>
<!--                     <div class="col-12 col-xl-auto mt-4">
                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-xxl-4 col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-12">
                                <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-success">Selamat Datang {{ Auth::user()->name }}!</h1>
                                    <p class="text-gray-700 mb-0">Di Sistem Informasi Administrasi Persuratan</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="/admin/assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Example Colored Cards for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-12 col-xl-4 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Surat Masuk</div>
                                <div class="text-lg fw-bold">{{$masuk}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="mail"></i>
                        </div>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="">Selengkapnya</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12 col-xl-4 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Surat Keluar</div>
                                <div class="text-lg fw-bold">{{$keluar}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="mail"></i>
                        </div>
                    </div>
                   <!--  <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="">Selengkapnya</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12 col-xl-4 mb-4">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Pegawai</div>
                                <div class="text-lg fw-bold">{{$pegawai}}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="mail"></i>
                        </div>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="">Selengkapnya</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12">
             <canvas id="myChart" width="400" height="200"></canvas>
         </div>
     </div>
 </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
use App\Models\Recomendation;
use App\Models\Keterangan;
use App\Models\Pemberitahuan;
use App\Models\Nikah;
use App\Models\Undangan;
use App\Models\Disposisi;
use App\Models\User;

$suratMasukArray = [];
$suratKeluarArray = [];
$pegawaiArray = [];

for ($i = 1; $i <= 12; $i++) {

    $recomendation=Recomendation::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $keterangan=Keterangan::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $pemberitahuan=Pemberitahuan::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $suratMasukArray[] = $recomendation+$keterangan+$pemberitahuan;

    $nikah = Nikah::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $undangan = Undangan::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $disposisi = Disposisi::whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $suratKeluarArray[] = $nikah+$undangan+$disposisi;

    $pegawai = User::where('jabatan','Petugas')->whereYear('created_at', now()->year)
    ->whereMonth('created_at', $i)
    ->count();

    $pegawaiArray[]=$pegawai;
}

@endphp

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Surat Masuk',
                borderColor: 'rgb(75, 192, 192)',
                data: @php echo json_encode($suratMasukArray) @endphp, 
            }, {
                label: 'Surat Keluar',
                borderColor: 'rgb(255, 99, 132)',
                data: @php echo json_encode($suratKeluarArray) @endphp,
            }, {
                label: 'Pegawai',
                borderColor: 'rgb(255, 205, 86)',
                data: @php echo json_encode($pegawaiArray) @endphp,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection