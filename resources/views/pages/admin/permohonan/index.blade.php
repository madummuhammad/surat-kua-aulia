@extends('layouts.admin')

@section('title')
Permohonan
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
                            Permohonan
                        </h1>
                        <div class="page-header-subtitle text-success">List Permohonan</div>
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permohonan</li>
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
                        List Permohonan
                        @if(auth()->user()->jabatan=='Masyarakat')
                        <a class="btn btn-sm btn-success" href="{{ route('permohonan.create') }}">
                            Tambah Permohonan
                        </a>
                        @endif
                        @if(auth()->user()->jabatan=='Kepala KUA')
                        <a class="btn btn-sm btn-primary" href="{{ route('permohonan.cetak-laporan') }}">
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
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>           
    </div>
</main>
@foreach($item as $item)
<div class="modal fade" id="upload{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{route('permohonan.upload',$item->id)}}" method="POST" enctype="multipart/form-data">
        @method('post')
        @csrf        
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" accept=".pdf" name="file" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </div>
</form>
</div>
</div>

<div class="modal fade" id="uploadbalasan{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{route('permohonan.upload_balasan',$item->id)}}" method="POST" enctype="multipart/form-data">
        @method('post')
        @csrf        
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Balasan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" accept=".pdf" name="file" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </div>
</form>
</div>
</div>

<div class="modal fade" id="tolak{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{route('permohonan.verification',$item->id)}}" method="POST" enctype="multipart/form-data">
        @method('post')
        @csrf        
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Permohonan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input name="status" value="0" hidden>
            <label for="" class="mb-3">Alasan Penolakan</label>
            <input type="text" name="alasan_penolakan" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tolak</button>
        </div>
    </div>
</form>
</div>
</div>
@endforeach
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
    { data: 'nama', name: 'nama' },
    { data: 'alamat', name: 'alamat' },
    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
    {
        data: 'status',
        name: 'status',
        render: function (data, type, full, meta) {
            if (data === 1) {
                return 'Diterima';
            } else if (data === 0) {
                return 'Ditolak';
            } else {
                return 'Belum Diverifikasi';
            }
        }
    },
    {
        data: 'alasan_ditolak',
        name: 'alasan_ditolak'
    },
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
