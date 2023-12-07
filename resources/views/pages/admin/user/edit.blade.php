@extends('layouts.admin')

@section('title')
Ubah Pengguna
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
                            Ubah Pengguna
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-success" href="{{ route('user.index') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Pengguna
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
                    <div class="card-header text-success">Informasi Akun</div>
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
                        <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="name">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text" value="{{ $item->nama }}"  required/>
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
                                    <label class="small mb-1" for="email">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" value="{{ $item->username }}" required/>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="department_id">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select">
                                        <option value="Laki-laki" @if($item->jenis_kelamin=='Laki-laki') selected @endif>Laki-laki</option>
                                        <option value="Perempuan"  @if($item->jenis_kelamin=='Perempuan') selected @endif>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="level">Jabatan</label>
                                    <select name="jabatan" class="form-select">
                                        <option value="Admin"  @if($item->jabatan=='Admin') selected @endif>Admin</option>
                                        <option value="Petugas"  @if($item->jabatan=='Petugas') selected @endif>Petugas</option>
                                        <option value="Penghulu"  @if($item->jabatan=='Penghulu') selected @endif>Penghulu</option>
                                        <option value="Kepala KUA" @if($item->jabatan=='Kepala KUA') selected @endif>Kepala KUA</option>
                                        <option value="Masyarakat" @if($item->jabatan=='Masyarakat') selected @endif>Masyakarat</option>
                                    </select>
                                    @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <!-- Form Group (Password)-->
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password"/>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>   
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-success" type="submit">
                                Perbarui Pengguna
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

