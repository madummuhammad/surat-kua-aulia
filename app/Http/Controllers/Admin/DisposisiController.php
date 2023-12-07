<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Disposisi;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Disposisi::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
             if(auth()->user()->jabatan=='Petugas'){
                return '
                <a class="btn btn-primary btn-xs" href="' . route('disposisi.edit', $item->id) . '">
                <i class="fas fa-edit"></i> &nbsp; Ubah
                </a>
                <a class="btn btn-secondary btn-xs" href="' . route('download-disposisi', $item->id) . '">
                <i class="fas fa-download"></i> &nbsp; Donwload
                </a>
                <form action="' . route('disposisi.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                ' . method_field('delete') . csrf_field() . '
                <button class="btn btn-danger btn-xs">
                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                </button>
                </form>
                ';
            }
        })
            ->editColumn('name', function ($item) {
                return $item->profile ? 
                '<div class="d-flex align-items-center">
                <div class="avatar me-2"><img class="avatar-img img-fluid" src="'. Storage::url($item->profile) .'" /></div>'.
                $item->nama .'
                </div>' 
                : 
                '<div class="d-flex align-items-center">
                <div class="avatar me-2"><img class="avatar-img img-fluid" src="https://ui-avatars.com/api/?name='.$item->nama.'" /></div>'.
                $item->nama .'
                </div>';
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        return view('pages.admin.disposisi.index');
    }

    public function download_disposisi($id)
    {
        $item = Disposisi::findOrFail($id);

        return Storage::download($item->file_disposisi);
    }

    public function cetak_laporan()
    {
        $query = Disposisi::latest()->get();
        return view('pages.admin.disposisi.laporan',[
            'item'=>$query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.disposisi.create');
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
            'no_disposisi' => 'required|unique:disposisi',
            'isi_disposisi' => 'required',
            'file_disposisi' => 'required|mimes:pdf|file',
            'tgl_keluar' => 'required',
        ]);
        $validatedData['id_petugas']=auth()->user()->id;
        if($request->file('file_disposisi')){
            $validatedData['file_disposisi'] = $request->file('file_disposisi')->store('assets/file-disposisi');
        }


        $surat=Disposisi::create($validatedData);

        return redirect()
        ->route('disposisi.index')
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
        $item = Disposisi::findOrFail($id);

        return view('pages.admin.disposisi.edit',[
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
            'no_disposisi' => 'required',
            'isi_disposisi' => 'required',
            'tgl_keluar' => 'required',
        ]);
        $validatedData['id_petugas']=auth()->user()->id;
        $item = Disposisi::findOrFail($id);

        if($request->file('file_disposisi')){
            $validatedData['file_disposisi'] = $request->file('file_disposisi')->store('assets/file-disposisi');
        }

        $item->update($validatedData);

        return redirect()
        ->route('disposisi.index')
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
        $item = Disposisi::findorFail($id);

        Storage::delete($item->file_surat);

        $item->delete();

        return redirect()
        ->route('disposisi.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function verification($id)
    {
        $item = Disposisi::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
        return redirect()
        ->route('disposisi.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }
}
