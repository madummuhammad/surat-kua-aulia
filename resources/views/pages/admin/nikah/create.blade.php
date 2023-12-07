@extends('layouts.admin')

@section('title')
Tambah Surat Permintaan Buku Nikah dan Akta Nikah
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                            Tambah Surat Permintaan Buku Nikah dan Akta Nikah
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
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
        <form action="{{ route('nikah.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header text-success">Form Surat</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="no_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" value="{{ old('no_surat') }}" name="no_surat" placeholder="Nomor Surat.." required>
                                </div>
                                @error('no_surat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="file_surat" class="col-sm-3 col-form-label">File Surat</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('file_surat') is-invalid @enderror" value="{{ old('file_surat') }}" accept=".pdf" name="file_surat" required>
                                    <div id="file_surat" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('file_surat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="isi_surat" class="col-sm-3 col-form-label">Isi Surat</label>
                                <div class="col-sm-9">
                                    <textarea name="isi_surat" class="form-control @error('isi_surat') is-invalid @enderror" cols="30" rows="10" required></textarea>
                                </div>
                                @error('isi_surat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" value="{{ old('tgl_keluar') }}" name="tgl_keluar" required>
                                </div>
                                @error('tgl_keluar')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('addon-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".selectx").select2({
        theme: "bootstrap-5"
    });
</script>
@endpush

