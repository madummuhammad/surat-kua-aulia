<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Permohonan;
use App\Models\Notification;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Notification::where('role',auth()->user()->jabatan)->where('type','Permohonan')->update(['read_at'=>date('Y-m-d H:i:s')]);
        if (request()->ajax()) {
            if(auth()->user()->jabatan=='Masyarakat'){
                $query = Permohonan::where('nik_user',auth()->user()->nik)->latest()->get();
            } else {
                $query = Permohonan::latest()->get();
            }

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                $buttons = '<a class="btn btn-success btn-xs" href="' . route('permohonan.show', $item->id) . '">
                <i class="fa fa-search-plus"></i> &nbsp; Detail
                </a>
                <form action="' . route('permohonan.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                ' . method_field('delete') . csrf_field() . '
                <button class="btn btn-danger btn-xs">
                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                </button>
                </form>';
                if(auth()->user()->jabatan=='Masyarakat'){
                    $buttons .='<a class="btn btn-primary btn-xs" href="' . route('permohonan.edit', $item->id) . '">
                    <i class="fas fa-edit"></i> &nbsp; Ubah
                    </a>
                    ';
                }
                if(auth()->user()->jabatan=='Petugas' AND $item->status==NULL && $item->status !==0){
                    $buttons.='
                    <form action="' . route('permohonan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan memverifikasi surat ini ?'".')">
                    ' . method_field('post') . csrf_field() . '
                    <input name="status" value="1" hidden>
                    <button class="btn btn-primary btn-xs">
                    Verifikasi
                    </button>
                    </form>
                    <button class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#tolak'.$item->id.'">
                    Tolak
                    </button>
                    ';
                }
                if(auth()->user()->jabatan=='Petugas' AND $item->status==1 AND $item->file==null){
                    $buttons.='<button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#upload'.$item->id.'">Upload</button>';
                };

                if(auth()->user()->jabatan=='Masyarakat' AND $item->status==1 AND $item->file!==null AND $item->file_balasan==null){
                    $buttons.='<button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#uploadbalasan'.$item->id.'">Upload Balasan</button>';
                };
                return $buttons;
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        $permohonan = Permohonan::latest()->get();
        return view('pages.admin.permohonan.index',[
            'item'=>$permohonan
        ]);
    }

    public function verification($id)
    {
        $item = Permohonan::findorFail($id);
        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
            $item->update(['status'=>request('status'),'alasan_ditolak'=>request('alasan_penolakan')]);
        } else {
            $item->update(['status'=>request('status')]);
        }

        Notification::create([
            'role'=>'Masyarakat',
            'user_id'=>$item->nik_user,
            'type'=>'Permohonan',
        ]);
        return redirect()
        ->route('permohonan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.permohonan.create');
    }

    public function cetak_laporan()
    {
        $query = Permohonan::latest()->get();
        $pegawai=Pegawai::where('jabatan','Kepala KUA')->first();
        return view('pages.admin.permohonan.laporan',[
            'item'=>$query,
            'pegawai'=>$pegawai
        ]);
    }

    public function download_permohonan($id)
    {
        $item = Permohonan::findOrFail($id);

        return Storage::download($item->file_permohonan);
    }

    public function download_hasil($id)
    {
        $item = Permohonan::findOrFail($id);

        return Storage::download($item->file);
    }

    public function download_balasan($id)
    {
        $item = Permohonan::findOrFail($id);

        return Storage::download($item->file_balasan);
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
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'file_permohonan' => 'required|mimes:pdf|file',
        ]);
        $validatedData['nik_user']=auth()->user()->nik;
        if($request->file('file_permohonan')){
            $validatedData['file_permohonan'] = $request->file('file_permohonan')->store('assets/file-permohonan');
        }


        $permohonan=Permohonan::create($validatedData);
        Notification::create([
            'role'=>'Penghulu',
            'user_id'=>null,
            'type'=>'Permohonan',
        ]);

        Notification::create([
            'role'=>'Petugas',
            'user_id'=>null,
            'type'=>'Permohonan',
        ]);
        return redirect()
        ->route('permohonan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function upload(Request $request,$id)
    {
        $file=null;
        if($request->file('file')){
            $file = $request->file('file')->store('assets/file');
        }

        Permohonan::where('id',$id)->update([
            'file'=>$file
        ]);

        $item=Permohonan::findOrFail($id);
        Notification::create([
            'role'=>'Masyarakat',
            'user_id'=>$item->nik_user,
            'type'=>'Permohonan',
        ]);
        return back();
    }

    public function upload_balasan(Request $request,$id)
    {
        $file=null;
        if($request->file('file')){
            $file = $request->file('file')->store('assets/file');
        }

        Permohonan::where('id',$id)->update([
            'file_balasan'=>$file
        ]);

        $item=Permohonan::findOrFail($id);
        Notification::create([
            'role'=>'Petugas',
            'user_id'=>null,
            'type'=>'Permohonan',
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Permohonan::with(['user'])->findOrFail($id);

        return view('pages.admin.permohonan.show',[
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=Permohonan::where('id',$id)->first();
        return view('pages.admin.permohonan.edit',[
            'item'=>$item
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
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        $validatedData['nik_user']=auth()->user()->nik;
        if($request->file('file_permohonan')){
            $validatedData['file_permohonan'] = $request->file('file_permohonan')->store('assets/file-permohonan');
        }

        $validatedData['status']=null;
        $validatedData['alasan_ditolak']=null;


        $permohonan=Permohonan::where('id',$id)->update($validatedData);
        Notification::create([
            'role'=>'Penghulu',
            'user_id'=>null,
            'type'=>'Permohonan',
        ]);

        Notification::create([
            'role'=>'Petugas',
            'user_id'=>null,
            'type'=>'Permohonan',
        ]);
        return redirect()
        ->route('permohonan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Permohonan::findorFail($id);

        $item->delete();

        return redirect()
        ->route('permohonan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
