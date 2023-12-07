@extends('layouts.admin')

@section('title')
Detail Permohonan
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon text-success"><i data-feather="file-text"></i></div>
                            Detail Permohonan
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-sm btn-light text-success" onclick="javascript:window.history.back();">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali Ke Semua Permohonan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header text-success">Detail Permohonan</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID Masyarakat</th>
                                        <td>{{ $item->id_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $item->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header text-success">
                        File Permohonan - 
                        <a href="{{ route('download-permohonan', $item->id) }}" class="btn btn-sm btn-success">  
                            <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Permohonan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <embed src="{{ Storage::url($item->file_permohonan) }}" width="500" height="500" type="application/pdf">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection

