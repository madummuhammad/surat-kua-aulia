<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Permohonan;
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
        if (request()->ajax()) {
            $query = Permohonan::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                $buttons = '<a class="btn btn-success btn-xs" href="' . route('permohonan.show', $item->id) . '">
                <i class="fa fa-search-plus"></i> &nbsp; Detail
                </a>
                ';
                if(auth()->user()->jabatan=='Masyarakat'){
                    $buttons .='<a class="btn btn-primary btn-xs" href="' . route('permohonan.edit', $item->id) . '">
                    <i class="fas fa-edit"></i> &nbsp; Ubah
                    </a>
                    ';
                }
                if(auth()->user()->jabatan=='Penghulu' AND $item->status!=1){
                    $buttons.='
                    <form action="' . route('permohonan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan memverifikasi surat ini ?'".')">
                    ' . method_field('post') . csrf_field() . '
                    <input name="status" value="1" hidden>
                    <button class="btn btn-primary btn-xs">
                    Verifikasi
                    </button>
                    </form>
                    <form action="' . route('permohonan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menolak surat ini ?'".')">
                    ' . method_field('post') . csrf_field() . '
                    <input name="status" value="0" hidden>
                    <button class="btn btn-danger btn-xs">
                    Tolak
                    </button>
                    </form>
                    ';
                }
                return $buttons;
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }
        return view('pages.admin.permohonan.index');
    }

    public function verification($id)
    {
        $item = Permohonan::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
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

    public function download_permohonan($id)
    {
        $item = Permohonan::findOrFail($id);

        return Storage::download($item->file_permohonan);
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
        $validatedData['id_user']=auth()->user()->id;
        if($request->file('file_permohonan')){
            $validatedData['file_permohonan'] = $request->file('file_permohonan')->store('assets/file-permohonan');
        }


        $permohonan=Permohonan::create($validatedData);

        return redirect()
        ->route('permohonan.index')
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
