<?php

namespace App\Http\Controllers\admin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pemberitahuan::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
              if(auth()->user()->jabatan=='Petugas' OR auth()->user()->jabatan=='Masyarakat'){
                $buttons='';
                if(auth()->user()->jabatan=='Petugas'){                        
                    $buttons.='
                    <a class="btn btn-primary btn-xs" href="' . route('pemberitahuan.edit', $item->id) . '">
                    <i class="fas fa-edit"></i> &nbsp; Ubah
                    </a>
                    <form action="' . route('pemberitahuan.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                    ' . method_field('delete') . csrf_field() . '
                    <button class="btn btn-danger btn-xs">
                    <i class="far fa-trash-alt"></i> &nbsp; Hapus
                    </button>
                    </form>
                    ';
                }



                $buttons .='<a class="btn btn-secondary btn-xs" href="' . route('download-pemberitahuan', $item->id) . '">
                <i class="fas fa-download"></i> &nbsp; Donwload
                </a>';

                return $buttons;
            }
        })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        return view('pages.admin.pemberitahuan.index');

    }

    public function print()
    {
        return view('pages.admin.pemberitahuan.print');
    }

    public function cetak_laporan()
    {
        $query = Pemberitahuan::latest()->get();
        return view('pages.admin.pemberitahuan.laporan',[
            'item'=>$query
        ]);
    }

    public function cetak(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat' => 'required|unique:surat_pemberitahuan_kekurangan_syarat_perkawinan',
            'tanggal' => 'required',
            'kepada' => 'required',
            'isi_surat' => 'required',
        ]);

        return view('pages.admin.pemberitahuan.cetak',[
            'item'=>$validatedData
        ]);
    }

    public function download_pemberitahuan($id)
    {
        $item = Pemberitahuan::findOrFail($id);

        return Storage::download($item->file_surat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pemberitahuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat' => 'required|unique:surat_pemberitahuan_kekurangan_syarat_perkawinan',
            'isi_surat' => 'required',
            'file_surat' => 'required|mimes:pdf|file',
            'tgl_keluar' => 'required',
        ]);
        $validatedData['id_petugas']=auth()->user()->id;
        if($request->file('file_surat')){
            $validatedData['file_surat'] = $request->file('file_surat')->store('assets/file-surat');
        }


        $surat=Pemberitahuan::create($validatedData);

        return redirect()
        ->route('pemberitahuan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Pemberitahuan::findOrFail($id);

        return view('pages.admin.pemberitahuan.edit',[
            'item' => $item,
        ]);
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
        $validatedData = $request->validate([
            'no_surat' => 'required',
            'isi_surat' => 'required',
            'tgl_keluar' => 'required',
        ]);
        $validatedData['id_petugas']=auth()->user()->id;
        $item = Pemberitahuan::findOrFail($id);

        if($request->file('file_surat')){
            $validatedData['file_surat'] = $request->file('file_surat')->store('assets/file-surat');
        }

        $item->update($validatedData);

        return redirect()
        ->route('pemberitahuan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pemberitahuan::findorFail($id);

        Storage::delete($item->file_surat);

        $item->delete();

        return redirect()
        ->route('pemberitahuan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function verification($id)
    {
        $item = Pemberitahuan::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
        return redirect()
        ->route('pemberitahuan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }
}
