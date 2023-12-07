<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recomendation;
use App\Models\Keterangan;
use App\Models\Pemberitahuan;
use App\Models\Nikah;
use App\Models\Undangan;
use App\Models\Disposisi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $recomendation=Recomendation::get()->count();
        $keterangan=Keterangan::get()->count();
        $pemberitahuan=Pemberitahuan::get()->count();
        $nikah=Nikah::get()->count();
        $undangan=Undangan::get()->count();
        $disposisi=Disposisi::get()->count();
        $masuk=$recomendation+$keterangan+$pemberitahuan;
        $keluar=$nikah+$undangan+$disposisi;
        $pegawai=User::where('jabatan','petugas')->get()->count();
        return view('pages.admin.dashboard',[
            'masuk'=>$masuk,
            'keluar'=>$keluar,
            'pegawai'=>$pegawai
        ]);
    }
}
