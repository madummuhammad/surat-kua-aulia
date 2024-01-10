<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Recomendation;
use App\Models\Pegawai;
use App\Models\CatinLaki;
use App\Models\CatinPerempuan;
use App\Rules\MinUmur;
use App\Models\Permohonan;

class RecomendationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Recomendation::with('laki','perempuan')->latest()->get();
            // if(auth()->user()->jabatan=='Masyarakat'){
            //     $query->where('id')
            // }
            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                if(auth()->user()->jabatan=='Petugas' OR auth()->user()->jabatan=='Masyarakat' OR auth()->user()->jabatan=='Penghulu'){
                    $buttons='';
                    if(auth()->user()->jabatan=='Petugas'){
                        if($item->status==0) {
                            $buttons.='<a class="btn btn-primary btn-xs" href="' . route('recomendation.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                            </a>';
                        }                       

                        $buttons.='
                        
                        <form action="' . route('recomendation.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                        ' . method_field('delete') . csrf_field() . '
                        <button class="btn btn-danger btn-xs">
                        <i class="far fa-trash-alt"></i> &nbsp; Hapus
                        </button>
                        </form>
                        ';
                    }

                    if($item->status==1){
                        $buttons .='<a class="btn btn-secondary btn-xs" target="_blank" href="' . route('recomendation.cetak', $item->id) . '">
                        <i class="fas fa-download"></i> &nbsp; Donwload
                        </a>';
                    }

                    if($item->status==0){
                        $buttons .='<a class="btn btn-secondary btn-xs" href="' . route('recomendation.cetak', $item->id) . '">
                        <i class="fas fa-eye"></i> &nbsp; Lihat
                        </a>';
                    }

                    if(auth()->user()->jabatan=='Penghulu' AND $item->status==0){
                        $buttons.='
                        <form action="' . route('recomendation.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan memverifikasi surat ini ?'".')">
                        ' . method_field('post') . csrf_field() . '
                        <input name="status" value="1" hidden>
                        <button class="btn btn-primary btn-xs">
                        Verifikasi
                        </button>
                        </form>
                        ';
                    }


                    return $buttons;
                }
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        
        return view('pages.admin.recomendation.index');
    }

    public function create()
    {
        $pegawai=Pegawai::get();
        $permohonan=Permohonan::get();
        return view('pages.admin.recomendation.create',[
            'pegawai'=>$pegawai,
            'permohonan'=>$permohonan
        ]);
    }

    public function print()
    {
        return view('pages.admin.recomendation.print');
    }

    public function cetak_laporan()
    {
        $pegawai=Pegawai::where('jabatan','Kepala KUA')->first();
        $query = Recomendation::latest()->get();
        return view('pages.admin.recomendation.laporan',[
            'item'=>$query,
            'pegawai'=>$pegawai
        ]);
    }

    public function cetak($id)
    {
       $item = Recomendation::where('id',$id)->with('laki','perempuan','pegawai')->first();
       return view('pages.admin.recomendation.cetak',[
        'item'=>$item
    ]);
   }

   public function show($id)
   {
    return 'asdf';
}

public function download_recomendation($id)
{
    $item = Recomendation::findOrFail($id);

    return Storage::download($item->file_surat);
}

public function store(Request $request)
{ 
    $validatedData = $request->validate([
        "nama_laki_laki"=> "required",
        "alamat_laki_laki"=> "required",
        "bin_binti_laki_laki"=> "required",
        "status_perkawinan_laki_laki"=> "required",
        "status_perkawinan_perempuan"=> "required",
        "bin_binti_perempuan"=> "required",
        "jenis_kelamin_laki_laki"=> "required",
        "nik_laki_laki"=> "required|numeric|digits:16",
        "pekerjaan_laki_laki"=> "required",
        "warga_negara_laki_laki"=> "required",
        "tempat_lahir_laki_laki"=> "required",
        "tgl_lahir_laki_laki" => ["required", new MinUmur(17)],
        "agama_laki_laki"=> "required",
        "nama_perempuan"=> "required",
        "alamat_perempuan"=> "required",
        "jenis_kelamin_perempuan"=> "required",
        "nik_perempuan"=> "required|numeric|digits:16",
        "pekerjaan_perempuan"=> "required",
        "warga_negara_perempuan"=> "required",
        "tempat_lahir_perempuan"=> "required",
        "tgl_lahir_perempuan" => ["required", new MinUmur(17)],
        "agama_perempuan"=> "required",
        "pegawai"=> "required"
    ]);

    $dataLakiLaki = array_filter($validatedData, function($key) {
        return strpos($key, '_laki_laki') !== false;
    }, ARRAY_FILTER_USE_KEY);

    $dataPerempuan = array_filter($validatedData, function($key) {
        return strpos($key, '_perempuan') !== false;
    }, ARRAY_FILTER_USE_KEY);

    $insertLaki=$this->konversiAtribut($dataLakiLaki,'_laki_laki');
    $insertPerempuan=$this->konversiAtribut($dataPerempuan,'_perempuan');

    $laki=CatinLaki::create($insertLaki);
    $perempuan=CatinPerempuan::create($insertPerempuan);

    Recomendation::create([
        'no_surat'=>'SRN/'.date('m').'/'.Recomendation::get()->count().'/'.date('Y'),
        'nik_pegawai'=>$validatedData['pegawai'],
        'nik_catin_laki_laki'=>$laki->nik,
        'nik_catin_perempuan'=>$perempuan->nik
    ]);

    return redirect()
    ->route('recomendation.index')
    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
}

private function konversiAtribut($data, $suffix)
{
    $convertedData = [];
    foreach ($data as $key => $value) {
        $newKey = str_replace($suffix, '', $key);
        $convertedData[$newKey] = $value;
    }

    return $convertedData;
}

public function edit($id)
{
    $item = Recomendation::with('laki','perempuan')->findOrFail($id);
    $pegawai=Pegawai::get();
    return view('pages.admin.recomendation.edit',[
        'item' => $item,
        'pegawai'=>$pegawai
    ]);
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        "nama_laki_laki"=> "required",
        "alamat_laki_laki"=> "required",
        "bin_binti_laki_laki"=> "required",
        "status_perkawinan_laki_laki"=> "required",
        "status_perkawinan_perempuan"=> "required",
        "bin_binti_perempuan"=> "required",
        "jenis_kelamin_laki_laki"=> "required",
        "nik_laki_laki"=> "required",
        "pekerjaan_laki_laki"=> "required",
        "warga_negara_laki_laki"=> "required",
        "tempat_lahir_laki_laki"=> "required",
        "tgl_lahir_laki_laki"=> "required",
        "agama_laki_laki"=> "required",
        "nama_perempuan"=> "required",
        "alamat_perempuan"=> "required",
        "jenis_kelamin_perempuan"=> "required",
        "nik_perempuan"=> "required",
        "pekerjaan_perempuan"=> "required",
        "warga_negara_perempuan"=> "required",
        "tempat_lahir_perempuan"=> "required",
        "tgl_lahir_perempuan"=> "required",
        "agama_perempuan"=> "required",
        "pegawai"=> "required"
    ]);

    $dataLakiLaki = array_filter($validatedData, function($key) {
        return strpos($key, '_laki_laki') !== false;
    }, ARRAY_FILTER_USE_KEY);

    $dataPerempuan = array_filter($validatedData, function($key) {
        return strpos($key, '_perempuan') !== false;
    }, ARRAY_FILTER_USE_KEY);

    $insertLaki=$this->konversiAtribut($dataLakiLaki,'_laki_laki');
    $insertPerempuan=$this->konversiAtribut($dataPerempuan,'_perempuan');

    $laki=CatinLaki::where('nik',$insertLaki['nik'])->update($insertLaki);
    $perempuan=CatinPerempuan::where('nik',$insertPerempuan['nik'])->update($insertPerempuan);

    Recomendation::where('id',$id)->update([
        'nik_pegawai'=>$validatedData['pegawai'],
        'nik_catin_laki_laki'=>$insertLaki['nik'],
        'nik_catin_perempuan'=>$insertPerempuan['nik']
    ]);

    return redirect()
    ->route('recomendation.index')
    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
}

public function destroy($id)
{
    $item = Recomendation::findorFail($id);

    Storage::delete($item->file_surat);

    $item->delete();

    return redirect()
    ->route('recomendation.index')
    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
}

public function verification($id)
{
    $item = Recomendation::findorFail($id);

    $item->update(['status'=>request('status')]);

    $status='verifikasi';
    if(request('status')==0){
        $status='tolak';
    }
    return redirect()
    ->route('recomendation.index')
    ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
}
}
