<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Notification;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->jabatan!=='Petugas'){
            return redirect('admin/dashboard');
        }
        if (request()->ajax()) {
            $query = Pegawai::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                return '
                <a class="btn btn-primary btn-xs" href="' . route('pegawai.edit', $item->nik) . '">
                <i class="fas fa-edit"></i> &nbsp; Ubah
                </a>
                <form action="' . route('pegawai.destroy', $item->nik) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                ' . method_field('delete') . csrf_field() . '
                <button class="btn btn-danger btn-xs">
                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                </button>
                </form>
                ';
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
        return view('pages.admin.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pegawai.create');
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
            'nik' => 'required|unique:pegawai|numeric|digits:16',
            'nama' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg|file',
            'agama' => 'required',
        ]);

        if($request->file('foto')){
            $validatedData['foto'] = $request->file('foto')->store('assets/foto');
        }

        Pegawai::create($validatedData);
        return redirect()
        ->route('pegawai.index')
        ->with('success', 'Sukses! Data Pengguna Berhasil Disimpan');
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
        $item = Pegawai::findOrFail($id);
        return view('pages.admin.pegawai.edit',[
            'item' => $item
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
        $item = Pegawai::findOrFail($id);
        $validatedData = $request->validate([
            'nik' => [
                'required'

            ],
            'nama' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
        ]);

        if($request->file('foto')){
            $validatedData['foto'] = $request->file('foto')->store('assets/foto');
        }

        $item->update($validatedData);

        return redirect()
        ->route('pegawai.index')
        ->with('success', 'Sukses! Data Pengguna Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pegawai::findorFail($id);

        Storage::delete($item->profile);

        $item->delete();

        return redirect()
        ->route('pegawai.index')
        ->with('success', 'Sukses! Data Pegawai telah dihapus');
    }
}
