@extends('layouts.admin')

@section('title')
Tambah Surat Undangan
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
                            Tambah Surat Undangan
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
        <form action="{{ route('undangan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header text-success">Form Undangan</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="no_undangan" class="col-sm-3 col-form-label">Nomor Undangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('no_undangan') is-invalid @enderror" value="{{ old('no_undangan') }}" name="no_undangan" placeholder="Nomor Undangan.." required>
                                </div>
                                @error('no_undangan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('sifat') is-invalid @enderror" value="{{ old('sifat') }}" name="sifat" placeholder="Sifat..." required>
                                </div>
                                @error('sifat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                                <div class="col-sm-9">
                                 <div class="mb-3">
                                    <select name="perihal" class="form-control selectx" >
                                        <option value="Surat Permintaan Buku Nikah dan Akta Nikah">Surat Permintaan Buku Nikah dan Akta Nikah</option>
                                        <option value="Surat pemberitahuan nasehat / bimbingan perkawinan">Surat pemberitahuan nasehat / bimbingan perkawinan</option>
                                        <option value="Surat pemberitahuan kekurangan syarat pernikahan">Surat pemberitahuan kekurangan syarat pernikahan</option>
                                    </select>
                                </div>
                            </div>
                            @error('perihal')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="lampiran" class="col-sm-3 col-form-label">Lampiran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('lampiran') is-invalid @enderror" value="{{ old('lampiran') }}" placeholder="Lampiran..." name="lampiran" required>
                            </div>
                            @error('lampiran')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="kepada" class="col-sm-3 col-form-label">Kepada</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('kepada') is-invalid @enderror" value="{{ old('kepada') }}" placeholder="Kepada..." name="kepada" required>
                            </div>
                            @error('kepada')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="perihal" class="col-sm-3 col-form-label">Pegawai</label>
                            <div class="col-sm-9">
                             <div class="mb-3">
                                <select name="nik_pegawai" class="form-control selectx">

                                    @foreach($item as $item)
                                    <option value="{{$item->nik}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pada" class="col-sm-3 col-form-label">Pada</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('pada') is-invalid @enderror" value="{{ old('pada') }}" placeholder="Pada..." name="pada" required>
                            </div>
                            @error('kepada')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="waktu" class="col-sm-3 col-form-label">Waktu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu') }}" placeholder="Waktu..." name="waktu" required>
                            </div>
                            @error('waktu')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror" value="{{ old('tempat') }}" placeholder="Tempat..." name="tempat" required>
                            </div>
                            @error('tempat')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="acara" class="col-sm-3 col-form-label">Acara</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('acara') is-invalid @enderror" value="{{ old('acara') }}" placeholder="Acara..." name="acara" required>
                            </div>
                            @error('acara')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
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
<script>
    $(document).ready(function(){
        $("#divreceiver").hide();
        $("#divsender").hide();
        $("#letter_type").on('change',function(){
            console.log($(this).val())
            if($(this).val()=='Surat Masuk'){
                $("#divreceiver").show();
                $("#divsender").hide();
            }
            if($(this).val()=='Surat Keluar'){
                $("#divreceiver").hide();
                $("#divsender").show();
            }
        });
    })
</script>
@endpush

