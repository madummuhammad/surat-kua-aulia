<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Nikah;

class NikahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Nikah::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                if(auth()->user()->jabatan=='Petugas'){
                    return '
                    <a class="btn btn-primary btn-xs" href="' . route('nikah.edit', $item->id) . '">
                    <i class="fas fa-edit"></i> &nbsp; Ubah
                    </a>
                    <a class="btn btn-secondary btn-xs" href="' . route('download-nikah', $item->id) . '">
                    <i class="fas fa-download"></i> &nbsp; Donwload
                    </a>
                    <form action="' . route('nikah.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                    ' . method_field('delete') . csrf_field() . '
                    <button class="btn btn-danger btn-xs">
                    <i class="far fa-trash-alt"></i> &nbsp; Hapus
                    </button>
                    </form>
                    ';
                }
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        return view('pages.admin.nikah.index');
    }

    public function cetak_laporan()
    {
        $query = Nikah::latest()->get();
        return view('pages.admin.nikah.laporan',[
            'item'=>$query
        ]);
    }

    public function print()
    {
        return view('pages.admin.nikah.print');
    }

    public function cetak(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat' => 'required|unique:surat_buku_nikah_akta_nikah',
            'tanggal' => 'required',
            'kepada' => 'required',
            'isi_surat' => 'required',
        ]);

        return view('pages.admin.nikah.cetak',[
            'item'=>$validatedData
        ]);
    }

    public function download_nikah($id)
    {
        $item = Nikah::findOrFail($id);

        return Storage::download($item->file_surat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.nikah.create');
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
            'no_surat' => 'required|unique:surat_buku_nikah_akta_nikah',
            'isi_surat' => 'required',
            'file_surat' => 'required|mimes:pdf|file',
            'tgl_keluar' => 'required',
        ]);
        $validatedData['id_petugas']=auth()->user()->id;
        if($request->file('file_surat')){
            $validatedData['file_surat'] = $request->file('file_surat')->store('assets/file-surat');
        }


        $surat=Nikah::create($validatedData);

        return redirect()
        ->route('nikah.index')
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
        $item = Nikah::findOrFail($id);

        return view('pages.admin.nikah.edit',[
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
        $item = Nikah::findOrFail($id);

        if($request->file('file_surat')){
            $validatedData['file_surat'] = $request->file('file_surat')->store('assets/file-surat');
        }

        $item->update($validatedData);

        return redirect()
        ->route('nikah.index')
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
        $item = Nikah::findorFail($id);

        Storage::delete($item->file_surat);

        $item->delete();

        return redirect()
        ->route('nikah.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function verification($id)
    {
        $item = Nikah::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
        return redirect()
        ->route('nikah.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }
}
