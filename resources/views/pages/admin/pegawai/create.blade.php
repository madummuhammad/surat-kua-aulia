@extends('layouts.admin')

@section('title')
Tambah Pengguna
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                            Tambah Pegawai
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-success" href="{{ route('pegawai.index') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header text-success">Pegawai</div>
                    <div class="card-body">
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
                        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="nik">NIK</label>
                                    <input class="form-control @error('nik') is-invalid @enderror" name="nik" type="text" value="{{ old('nik') }}"  required autofocus/>
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="nama">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text" value="{{ old('nama') }}"  required autofocus/>
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="alamat">Alamat</label>
                                    <input class="form-control @error('alamat') is-invalid @enderror" name="alamat" type="alamat" value="{{ old('alamat') }}" required/>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="jabatan">Jabatan</label>
                                    <select name="jabatan" class="form-select">
                                        <option value="Penghulu">Penghulu</option>
                                        <option value="Kepala KUA">Kepala KUA</option>
                                    </select>
                                    @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="foto">Foto</label>
                                    <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" value="{{ old('foto') }}" required/>
                                    @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-6">
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
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="" class="form-select">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-success" type="submit">
                                Tambah Pegawai
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

