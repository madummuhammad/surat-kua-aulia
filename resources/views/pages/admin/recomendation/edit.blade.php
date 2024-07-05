@extends('layouts.admin')

@section('title')
Ubah Surat
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
                            Ubah Surat Rekomendasi Nikah
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
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Calon Laki-laki</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Calon Perempuan</button>
        </li>
    </ul>
    <form action="{{ route('recomendation.update',$item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row gx-4">
                    <div class="col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header text-success">Form Laki-laki</div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama_laki_laki') is-invalid @enderror" value="{{ $item->laki->nama }}" name="nama_laki_laki" placeholder="Nama Calon Laki-laki.." >
                                    </div>
                                    @error('nama_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="bin_binti_laki_laki" class="col-sm-3 col-form-label">Bin Binti</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('bin_binti_laki_laki') is-invalid @enderror" value="{{ $item->laki->bin_binti }}" name="bin_binti_laki_laki" placeholder="Bin binti Laki-laki.." >
                                    </div>
                                    @error('bin_binti_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('alamat_laki_laki') is-invalid @enderror" value="{{ $item->laki->alamat }}" name="alamat_laki_laki" placeholder="Alamat.." >
                                    </div>
                                    @error('alamat_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="jenis_kelamin_laki_laki" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select name="jenis_kelamin_laki_laki" class="form-control selectx" >
                                            <option value="Laki-laki">Laki-laki</option>
                                        </select>
                                    </div>
                                    @error('jenis_kelamin_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nik_laki_laki') is-invalid @enderror" value="{{ $item->laki->nik }}" name="nik_laki_laki" placeholder="NIK Calon Laki-laki.." readonly>
                                    </div>
                                    @error('nik_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <label for="pekerjaan_laki_laki" class="col-sm-3 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('pekerjaan_laki_laki') is-invalid @enderror" value="{{ $item->laki->pekerjaan }}" name="pekerjaan_laki_laki" placeholder="Pekerjaan.." >
                                    </div>
                                    @error('pekerjaan_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <label for="warga_negara_laki_laki" class="col-sm-3 col-form-label">Warga Negara</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('warga_negara_laki_laki') is-invalid @enderror" value="{{ $item->laki->warga_negara }}" name="warga_negara_laki_laki" placeholder="Warga negara.." >
                                    </div>
                                    @error('warga_negara_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                                    <div class="col-sm-9 d-flex ">
                                        <input type="text" class="form-control @error('tempat_lahir_laki_laki') is-invalid @enderror" value="{{ $item->laki->tempat_lahir }}" name="tempat_lahir_laki_laki" placeholder="Tempat.." >
                                        <input type="date" class="form-control @error('tgl_lahir_laki_laki') is-invalid @enderror" value="{{ $item->laki->tgl_lahir }}" name="tgl_lahir_laki_laki" placeholder="tgl_lahir_laki_laki.." >
                                    </div>
                                    @error('tempat_lahir_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                    @error('tgl_lahir_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="agama_laki_laki" class="col-sm-3 col-form-label">Agama</label>
                                    <div class="col-sm-9">
                                     <select name="agama_laki_laki" class="form-control selectx" required>
                                        <option value="Islam" @if($item->laki->agama=='Islam') selected @endif>Islam</option>
                                        <option value="Kristen"@if($item->laki->agama=='Kristen') selected @endif>Kristen</option>
                                        <option value="Budha"@if($item->laki->agama=='Budha') selected @endif>Budha</option>
                                        <option value="Hindu"@if($item->laki->agama=='Hindu') selected @endif>Hindu</option>
                                        <option value="Katholik"@if($item->laki->agama=='Katholik') selected @endif>Katholik</option>
                                        <option value="Konghucu"@if($item->laki->agama=='Konghucu') selected @endif>Konghucu</option>
                                    </select>
                                </div>
                                @error('agama_laki_laki')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="status_perkawinan_laki_laki" class="col-sm-3 col-form-label">Status Perkawinan</label>
                                <div class="col-sm-9">
                                    <select name="status_perkawinan_laki_laki" class="form-control selectx" >
                                        <option value="Kawin" @if($item->laki->agama=='Kawin') selected @endif>Kawin</option>
                                        <option value="Belum Kawin" @if($item->laki->agama=='Belum Kawin') selected @endif>Belum Kawin</option>
                                    </select>
                                </div>
                                @error('status_perkawinan_laki_laki')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                             <button class="btn btn-success" id="laki_next" type="button">Lanjut</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
           <div class="row gx-4">
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-header text-success">Form Perempuan</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama_perempuan" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama_perempuan') is-invalid @enderror" value="{{ $item->perempuan->nama }}" name="nama_perempuan" placeholder="Nama Calon Laki-laki.." >
                            </div>
                            @error('nama_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="bin_binti_perempuan" class="col-sm-3 col-form-label">Bin Binti</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('bin_binti_perempuan') is-invalid @enderror" value="{{ $item->perempuan->bin_binti }}" name="bin_binti_perempuan" placeholder="Bin binti Laki-laki.." >
                            </div>
                            @error('bin_binti_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('alamat_perempuan') is-invalid @enderror" value="{{ $item->perempuan->alamat }}" name="alamat_perempuan" placeholder="Alamat.." >
                            </div>
                            @error('alamat_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_kelamin_perempuan" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jenis_kelamin_perempuan" class="form-control selectx" >
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            @error('jenis_kelamin_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nik_perempuan') is-invalid @enderror" value="{{ $item->perempuan->nik }}" name="nik_perempuan" placeholder="NIK Calon Laki-laki.." readonly>
                            </div>
                            @error('nik_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <label for="pekerjaan_perempuan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('pekerjaan_perempuan') is-invalid @enderror" value="{{ $item->perempuan->pekerjaan }}" name="pekerjaan_perempuan" placeholder="Pekerjaan.." >
                            </div>
                            @error('pekerjaan_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <label for="warga_negara_perempuan" class="col-sm-3 col-form-label">Warga Negara</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('warga_negara_perempuan') is-invalid @enderror" value="{{ $item->perempuan->warga_negara }}" name="warga_negara_perempuan" placeholder="Warga negara.." >
                            </div>
                            @error('warga_negara_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9 d-flex ">
                                <input type="text" class="form-control @error('tempat_lahir_perempuan') is-invalid @enderror" value="{{ $item->perempuan->tempat_lahir }}" name="tempat_lahir_perempuan" placeholder="Tempat.." >
                                <input type="date" class="form-control @error('tgl_lahir_perempuan') is-invalid @enderror" value="{{ $item->perempuan->tgl_lahir }}" name="tgl_lahir_perempuan" placeholder="tgl_lahir_perempuan.." >
                            </div>
                            @error('tempat_lahir_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                            @error('tgl_lahir_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="agama_perempuan" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select name="agama_perempuan" class="form-control selectx" required>
                                        <option value="Islam" @if($item->perempuan->agama=='Islam') selected @endif>Islam</option>
                                        <option value="Kristen"@if($item->perempuan->agama=='Kristen') selected @endif>Kristen</option>
                                        <option value="Budha"@if($item->perempuan->agama=='Budha') selected @endif>Budha</option>
                                        <option value="Hindu"@if($item->perempuan->agama=='Hindu') selected @endif>Hindu</option>
                                        <option value="Katholik"@if($item->perempuan->agama=='Katholik') selected @endif>Katholik</option>
                                        <option value="Konghucu"@if($item->perempuan->agama=='Konghucu') selected @endif>Konghucu</option>
                                    </select>
                            </div>
                            @error('agama_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label for="status_perkawinan_perempuan" class="col-sm-3 col-form-label">Status Perkawinan</label>
                            <div class="col-sm-9">
                                <select name="status_perkawinan_perempuan" class="form-control selectx" >
                                        <option value="Kawin" @if($item->laki->agama=='Kawin') selected @endif>Kawin</option>
                                        <option value="Belum Kawin" @if($item->laki->agama=='Belum Kawin') selected @endif>Belum Kawin</option>
                                    </select>
                            </div>
                            @error('status_perkawinan_perempuan')
                            <div class="invalid-feedback">
                                {{ $message; }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-end">
                         <button class="btn btn-success" id="perempuan_next" type="submit">Kirim</button>
                     </div>
                 </div>
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
<script>
    $("#laki_next").on('click',function(){
        $("#profile").addClass('active')
        $("#profile").addClass('show')
        $("#home").removeClass('show')
        $("#home").removeClass('active')

        $("[data-bs-target='#profile']").addClass('active');
        $("[data-bs-target='#profile']").addClass('show');
        $("[data-bs-target='#home']").removeClass('active');
        $("[data-bs-target='#home']").removeClass('show');
    })

    $("#perempuan_next").on('click',function(){
        // $("#contact").addClass('active')
        // $("#contact").addClass('show')
        // $("#profile").removeClass('show')
        // $("#profile").removeClass('active')

        // $("[data-bs-target='#contact']").addClass('active');
        // $("[data-bs-target='#contact']").addClass('show');
        // $("[data-bs-target='#profile']").removeClass('active');
        // $("[data-bs-target='#profile']").removeClass('show');
    })
</script>
@endpush

