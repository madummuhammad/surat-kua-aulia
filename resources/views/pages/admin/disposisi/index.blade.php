@extends('layouts.admin')

@section('title')
Surat Disposisi
@endsection

@section('container')
<main>
    <header class="page-header page-header-dark bg-success pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon">
                                <i data-feather="file-text"></i>
                            </div>
                            Surat Disposisi
                        </h1>
                        <div class="page-header-subtitle text-success">List Surat Disposisi</div>
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surat Disposisi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-header-actions mb-4">
                    <div class="card-header text-success">
                        List Surat Disposisi
                        @if(auth()->user()->jabatan=='Petugas')
                        <a class="btn btn-sm btn-success" href="{{ route('disposisi.create') }}">
                            Tambah Surat Disposisi
                        </a>
                        @endif
                        @if(auth()->user()->jabatan=='Kepala KUA')
                        <a class="btn btn-sm btn-primary" href="{{ route('disposisi.cetak-laporan') }}">
                         Cetak Laporan
                     </a>
                     @endif
                 </div>
                 <div class="card-body">
                    {{-- Alert --}}
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- List Data --}}
                    <table class="table table-striped table-hover table-sm" id="crudTable">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th>Nomor Disposisi</th>
                                <th>Isi Disposisi</th>
                                <th>Tanggal Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>           
</div>
</main>
@endsection

@push('addon-script')
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{{ url()->current() }}',
      },
      columns: [
      {
        "data": 'DT_RowIndex',
        orderable: false, 
        searchable: false
    },
    { data: 'no_disposisi', name: 'no_disposisi' },
    { data: 'isi_disposisi', name: 'isi_disposisi' },
    { data: 'tgl_keluar', name: 'tgl_keluar' },
    { 
        data: 'action', 
        name: 'action',
        orderable: false,
        searchable: false,
        width: '15%'
    },
    ]
});
</script>
@endpush
