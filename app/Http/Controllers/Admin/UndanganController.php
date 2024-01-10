<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Undangan;
use App\Models\Pegawai;

class UndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Undangan::latest()->get();

            return Datatables::of($query)
            ->addColumn('action', function ($item) {
                $buttons='';
                if(auth()->user()->jabatan=='Petugas'){
                    $buttons.='
                    <a class="btn btn-primary btn-xs" href="' . route('undangan.edit', $item->id) . '">
                    <i class="fas fa-edit"></i> &nbsp; Ubah
                    </a>
                    <a class="btn btn-secondary btn-xs" href="' . route('undangan.cetak', $item->id) . '">
                    <i class="fas fa-download"></i> &nbsp; Download
                    </a>
                    <form action="' . route('undangan.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                    ' . method_field('delete') . csrf_field() . '
                    <button class="btn btn-danger btn-xs">
                    <i class="far fa-trash-alt"></i> &nbsp; Hapus
                    </button>
                    </form>
                    ';
                }

                if(auth()->user()->jabatan=='Penghulu' AND $item->status!=1){
                    $buttons.='
                    <form action="' . route('undangan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan memverifikasi surat ini ?'".')">
                    ' . method_field('post') . csrf_field() . '
                    <input name="status" value="1" hidden>
                    <button class="btn btn-primary btn-xs">
                    Verifikasi
                    </button>
                    </form>
                    <form action="' . route('undangan.verification', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menolak surat ini ?'".')">
                    ' . method_field('post') . csrf_field() . '
                    <input name="status" value="0" hidden>
                    <button class="btn btn-danger btn-xs">
                    Tolak
                    </button>
                    </form>
                    ';
                } 

                if(auth()->user()->jabatan=='Penghulu' AND $item->status==1){ 
                    $buttons.=' <a class="btn btn-secondary btn-xs" href="' . route('undangan.cetak', $item->id) . '">
                    <i class="fas fa-download"></i> &nbsp; Detail
                    </a>';
                }

                return $buttons;
            })
            ->addIndexColumn()
            ->removeColumn('id')
            ->rawColumns(['action','name'])
            ->make();
        }

        return view('pages.admin.undangan.index');
    }

    public function print()
    {
        return view('pages.admin.undangan.print');
    }

    public function cetak_laporan()
    {
        $pegawai=Pegawai::where('jabatan','Kepala KUA')->first();
        $query = Undangan::latest()->get();
        return view('pages.admin.undangan.laporan',[
            'item'=>$query,
            'pegawai'=>$pegawai
        ]);
    }

    public function cetak($id)
    {
        $item=Undangan::with('pegawai')->findorFail($id);
        return view('pages.admin.undangan.cetak',[
            'item'=>$item
        ]);
    }

    public function download_undangan($id)
    {
        $item = Undangan::findOrFail($id);

        return Storage::download($item->file_undangan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item=Pegawai::get();
        return view('pages.admin.undangan.create',[
            'item'=>$item
        ]);
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
            'no_undangan' => 'required|unique:undangan',
            'sifat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'kepada' => 'required',
            'nik_pegawai' => 'required',
            'pada' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'acara' => 'required',
        ]);

        $validatedData['pada'] = $this->konversiTanggal($validatedData['pada']);

        $undangan = Undangan::create($validatedData);

        return redirect()
        ->route('undangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    private function konversiTanggal($tanggal)
    {
        $timestamp = strtotime($tanggal);

        $hari = date('l', $timestamp);
        $bulan = date('F', $timestamp); 

        $hariIndonesia = $this->konversiHariIndonesia($hari);
        $bulanIndonesia = $this->konversiBulanIndonesia($bulan);

        return $hariIndonesia . ', ' . date('d', $timestamp) . ' ' . $bulanIndonesia . ' ' . date('Y', $timestamp);
    }

    private function konversiHariIndonesia($hariInggris)
    {
        $daftarHari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        return $daftarHari[$hariInggris];
    }

    private function konversiBulanIndonesia($bulanInggris)
    {
        $daftarBulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        return $daftarBulan[$bulanInggris];
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
        $item = Undangan::findOrFail($id);
        $pegawai=Pegawai::get();
        return view('pages.admin.undangan.edit',[
            'item' => $item,
            'pegawai' => $pegawai,
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
            'no_undangan' => 'required',
            'sifat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'kepada' => 'required',
            'nik_pegawai' => 'required',
            'pada' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'acara' => 'required',
        ]);

        $validatedData['pada'] = $this->konversiTanggal($validatedData['pada']);

        $item = Undangan::findOrFail($id);

        $item->update($validatedData);

        return redirect()
        ->route('undangan.index')
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
        $item = Undangan::findorFail($id);

        Storage::delete($item->file_surat);

        $item->delete();

        return redirect()
        ->route('undangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
    public function verification($id)
    {
        $item = Undangan::findorFail($id);

        $item->update(['status'=>request('status')]);

        $status='verifikasi';
        if(request('status')==0){
            $status='tolak';
        }
        return redirect()
        ->route('undangan.index')
        ->with('success', 'Sukses! 1 Data Berhasil Di'.$status);
    }
}
