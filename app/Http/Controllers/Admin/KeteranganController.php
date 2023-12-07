<?php

namespace App\Http\Controllers\admin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keterangan;
use App\Models\Pegawai;
use App\Models\Suami;
use App\Models\Istri;

class KeteranganController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Keterangan::with('laki')->latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {

                if(auth()->user()->jabatan=='Petugas' OR auth()->user()->jabatan=='Masyarakat' OR auth()->user()->jabatan=='Penghulu'){
                    $buttons='';
                    if(auth()->user()->jabatan=='Petugas'){
                        if($item->status==0) {
                            $buttons.='<a class="btn btn-primary btn-xs" href="' . route('keterangan.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                            </a>';
                        }                       

                        $buttons.='
                        
                        <form action="' . route('keterangan.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                        ' . method_field('delete') . csrf_field() . '
                        <button class="btn btn-danger btn-xs">
                        <i class="far fa-trash-alt"></i> &nbsp; Hapus
                        </button>
                        </form>
                        ';
                    }

                    if($item->status==1){
                        $buttons .='<a class="btn btn-secondary btn-xs" target="_blank" href="' . route('keterangan.cetak', $item->id) . '">
                        <i class="fas fa-download"></i> &nbsp; Donwload
                        </a>';
                    }

                    if($item->status==0 AND auth()->user()->jabatan=='Penghulu'){
                        $buttons .='<a class="btn btn-secondary btn-xs" href="' . route('keterangan.cetak', $item->id) . '">
                        <i class="fas fa-eye"></i> &nbsp; Lihat
                        </a>';
                    }

                    if(auth()->user()->jabatan=='Penghulu' AND $item->status==0){
                        $buttons.='
                        <form action="' . route('keterangan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan memverifikasi surat ini ?'".')">
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
        return view('pages.admin.keterangan.index');
    }

    public function create()
    {
        $pegawai=Pegawai::get();
        return view('pages.admin.keterangan.create',[
            'pegawai'=>$pegawai
        ]);
    }

    public function print()
    {
        return view('pages.admin.keterangan.print');
    }

    public function cetak_laporan()
    {
        $query = Keterangan::latest()->get();
        return view('pages.admin.keterangan.laporan',[
            'item'=>$query
        ]);
    }

    public function cetak($id)
    {
        $item = Keterangan::where('id',$id)->with('laki','perempuan','pegawai')->first();
        return view('pages.admin.keterangan.cetak',[
            'item'=>$item
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_laki_laki"=> "required",
            "alamat_laki_laki"=> "required",
            "jenis_kelamin_laki_laki"=> "required",
            "nik_laki_laki"=> "required",
            "pekerjaan_laki_laki"=> "required",
            "tempat_lahir_laki_laki"=> "required",
            "tgl_lahir_laki_laki"=> "required",
            "nama_perempuan"=> "required",
            "alamat_perempuan"=> "required",
            "nik_perempuan"=> "required",
            "pekerjaan_perempuan"=> "required",
            "tempat_lahir_perempuan"=> "required",
            "tgl_lahir_perempuan"=> "required",
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

        $laki=Suami::create($insertLaki);
        $perempuan=Istri::create($insertPerempuan);

        Keterangan::create([
            'no_surat'=>'SKNTC/'.date('m').'/'.Keterangan::get()->count().'/'.date('Y'),
            'nik_pegawai'=>$validatedData['pegawai'],
            'nik_suami'=>$laki->nik,
            'nik_istri'=>$perempuan->nik
        ]);

        return redirect()
        ->route('keterangan.index')
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

    public function download_keterangan($id)
    {
        $item = Keterangan::findOrFail($id);

        return Storage::download($item->file_surat);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Keterangan::with('laki','perempuan')->findOrFail($id);
        $pegawai=Pegawai::get();
        return view('pages.admin.keterangan.edit',[
            'item' => $item,
            'pegawai'=>$pegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "nama_laki_laki"=> "required",
            "alamat_laki_laki"=> "required",
            "jenis_kelamin_laki_laki"=> "required",
            "nik_laki_laki"=> "required",
            "pekerjaan_laki_laki"=> "required",
            "tempat_lahir_laki_laki"=> "required",
            "tgl_lahir_laki_laki"=> "required",
            "nama_perempuan"=> "required",
            "alamat_perempuan"=> "required",
            "nik_perempuan"=> "required",
            "pekerjaan_perempuan"=> "required",
            "tempat_lahir_perempuan"=> "required",
            "tgl_lahir_perempuan"=> "required",
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

        $laki=Suami::where('nik',$insertLaki['nik'])->update($insertLaki);
        $perempuan=Istri::where('nik',$insertPerempuan['nik'])->update($insertPerempuan);

        Keterangan::where('id',$id)->update([
            'nik_pegawai'=>$validatedData['pegawai'],
            'nik_suami'=>$insertLaki['nik'],
            'nik_istri'=>$insertPerempuan['nik']
        ]);

        return redirect()
        ->route('keterangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Keterangan::findorFail($id);

        Storage::delete($item->file_surat);

        $item->delete();

        return redirect()
        ->route('keterangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function verification($id)
    {
        $item = Keterangan::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
        return redirect()
        ->route('keterangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }
}
