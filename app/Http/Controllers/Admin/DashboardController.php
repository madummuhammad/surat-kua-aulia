<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recomendation;
use App\Models\Keterangan;
use App\Models\Undangan;
use App\Models\Permohonan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $recomendation=Recomendation::get()->count();
        $keterangan=Keterangan::get()->count();
        $undangan=Undangan::get()->count();
        $masuk=$recomendation+$keterangan;
        $keluar=$undangan;
        $pegawai=User::where('jabatan','petugas')->get()->count();
        $permohonan=Permohonan::get()->count();
        return view('pages.admin.dashboard',[
            'masuk'=>$masuk,
            'keluar'=>$keluar,
            'pegawai'=>$pegawai,
            'permohonan'=>$permohonan
        ]);
    }
}
