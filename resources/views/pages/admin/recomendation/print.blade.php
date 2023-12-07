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
                            Buat Surat Rekomendasi Nikah
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
        <form action="{{ route('recomendation.cetak') }}" method="post" enctype="multipart/form-data">
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
                                <label for="nama_perempuan" class="col-sm-3 col-form-label">Nama Perempuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama_perempuan') is-invalid @enderror" value="{{ old('_perempuan') }}" name="nama_perempuan" placeholder="Nama Perempuan.." required>
                                </div>
                                @error('nama_perempuan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat_perempuan" class="col-sm-3 col-form-label">Alamat Perempuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('alamat_perempuan') is-invalid @enderror" value="{{ old('alamat_perempuan') }}" name="alamat_perempuan" placeholder="Alamat Perempuan.." required>
                                </div>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan_perempuan" class="col-sm-3 col-form-label">Pekerjaan Perempuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('pekerjaan_perempuan') is-invalid @enderror" value="{{ old('pekerjaan_perempuan') }}" name="pekerjaan_perempuan" placeholder="Pekerjaan Perempuan.." required>
                                </div>
                                @error('pekerjaan_perempuan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row d-flex align-items-start">
                                <label for="status_perkawinan_perempuan" class="col-sm-3 col-form-label">Status Perkawinan</label>
                                <div class="col-sm-9">
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_perkawinan_perempuan" id="belum_kawin" value="Belum Kawin">
                                    <label class="form-check-label" for="belum_kawin">
                                        Belum Kawin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_perkawinan_perempuan" id="menikah" value="Kawin">
                                    <label class="form-check-label" for="Kawin">
                                        Kawin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_perkawinan_perempuan" id="cerai" value="Cerai">
                                    <label class="form-check-label" for="cerai">
                                        Cerai
                                    </label>
                                </div>
                            </div>
                            @error('status_perkawinan_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="bin_binti_perempuan" class="col-sm-3 col-form-label">Bin Binti Perempuan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('bin_binti_perempuan') is-invalid @enderror" value="{{ old('bin_binti_perempuan') }}" name="bin_binti_perempuan" placeholder="Bin Binti.." required>
                            </div>
                            @error('bin_binti_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="agama_perempuan" class="col-sm-3 col-form-label">Agama Perempuan</label>
                            <div class="col-sm-9">
                                <select name="agama_perempuan" class="form-control selectx" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            @error('agama_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir Perempuan</label>
                            <div class="col-sm-9 d-flex ">
                                <input type="text" class="form-control @error('tempat_perempuan') is-invalid @enderror" value="{{ old('tempat_perempuan') }}" name="tempat_perempuan" placeholder="Tempat.." required>
                                <input type="date" class="form-control @error('tgl_lahir_perempuan') is-invalid @enderror" value="{{ old('tgl_lahir_perempuan') }}" name="tgl_lahir_perempuan" placeholder="tgl_lahir_perempuan.." required>
                            </div>
                            @error('bin_binti')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        ------
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Laki-laki</label>
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
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat Laki-laki</label>
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
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan Laki-laki</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" name="pekerjaan" placeholder="Pekerjaan.." required>
                            </div>
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row d-flex align-items-start">
                            <label for="status_perkawinan" class="col-sm-3 col-form-label">Status Perkawinan Laki-laki</label>
                            <div class="col-sm-9">
                             <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_perkawinan" id="belum_kawin" value="Belum Kawin">
                                <label class="form-check-label" for="belum_kawin">
                                    Belum Kawin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_perkawinan" id="menikah" value="Kawin">
                                <label class="form-check-label" for="Kawin">
                                    Kawin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_perkawinan" id="cerai" value="Cerai">
                                <label class="form-check-label" for="cerai">
                                    Cerai
                                </label>
                            </div>
                        </div>
                        @error('status_perkawinan')
                        <div class="invalid-feedback">
                            {{ $message; }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="bin_binti" class="col-sm-3 col-form-label">Bin Binti Laki-laki</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('bin_binti') is-invalid @enderror" value="{{ old('bin_binti') }}" name="bin_binti" placeholder="Bin Binti.." required>
                        </div>
                        @error('bin_binti')
                        <div class="invalid-feedback">
                            {{ $message; }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama Laki-laki</label>
                        <div class="col-sm-9">
                            <select name="agama" class="form-control selectx" required>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        @error('agama')
                        <div class="invalid-feedback">
                            {{ $message; }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir Laki-laki</label>
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

