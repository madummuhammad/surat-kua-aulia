@extends('layouts.admin')

@section('title')
Buat Surat
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
                            Buat Keterangan Nikah Tidak Tercatat
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
        <form action="{{ route('keterangan.cetak') }}" method="post" enctype="multipart/form-data">
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
                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" name="tanggal" placeholder="Tanggal.." required>
                                </div>
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_istri" class="col-sm-3 col-form-label">Nama Istri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama_istri') is-invalid @enderror" value="{{ old('_istri') }}" name="nama_istri" placeholder="Nama Istri.." required>
                                </div>
                                @error('nama_istri')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="nik_istri" class="col-sm-3 col-form-label">NIK Istri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nik_istri') is-invalid @enderror" value="{{ old('nik_istri') }}" name="nik_istri" placeholder="NIK Istri.." required>
                                </div>
                                @error('nik_istri')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat_istri" class="col-sm-3 col-form-label">Alamat Istri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('alamat_istri') is-invalid @enderror" value="{{ old('alamat_istri') }}" name="alamat_istri" placeholder="Alamat Istri.." required>
                                </div>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan_istri" class="col-sm-3 col-form-label">Pekerjaan Istri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('pekerjaan_istri') is-invalid @enderror" value="{{ old('pekerjaan_istri') }}" name="pekerjaan_istri" placeholder="Pekerjaan Istri.." required>
                                </div>
                                @error('pekerjaan_istri')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir Istri</label>
                                <div class="col-sm-9 d-flex ">
                                    <input type="text" class="form-control @error('tempat_istri') is-invalid @enderror" value="{{ old('tempat_istri') }}" name="tempat_istri" placeholder="Tempat.." required>
                                    <input type="date" class="form-control @error('tgl_lahir_istri') is-invalid @enderror" value="{{ old('tgl_lahir_istri') }}" name="tgl_lahir_istri" placeholder="tgl_lahir_istri.." required>
                                </div>
                                @error('bin_binti')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            ------
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Suami</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama" placeholder="Nama.." required>
                                </div>
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK Suami</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('_istri') }}" name="nik" placeholder="NIK Suami.." required>
                                </div>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat Suami</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" name="alamat" placeholder="Alamat.." required>
                                </div>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan Suami</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" name="pekerjaan" placeholder="Pekerjaan.." required>
                                </div>
                                @error('pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir Suami</label>
                                <div class="col-sm-9 d-flex ">
                                    <input type="text" class="form-control @error('tempat') is-invalid @enderror" value="{{ old('tempat') }}" name="tempat" placeholder="Tempat.." required>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" name="tgl_lahir" placeholder="tgl_lahir.." required>
                                </div>
                                @error('bin_binti')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="isi_surat" class="col-sm-3 col-form-label">Isi Surat</label>
                                <div class="col-sm-9 d-flex ">
                                    <textarea name="isi_surat" id="" cols="30" rows="10" class="form-control">{{old('isi_surat')}}</textarea>
                                </div>
                                @error('isi_surat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success">Cetak</button>
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

