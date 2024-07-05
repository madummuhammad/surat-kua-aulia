@extends('layouts.admin')

@section('title')
Tambah Surat
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
                            Tambah Surat Rekomendasi Nikah
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

        <div id="error-tgl-laki">

        </div>
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Calon Laki-laki</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Calon Perempuan</button>
        </li>
    </ul>
    <form action="{{ route('recomendation.store') }}" id="recomendation_form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row gx-4">
                    <div class="col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header text-success">Form Laki-laki</div>
                            <div class="card-body">
                              <!--   <div class="mb-3 row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama_laki_laki') is-invalid @enderror" value="{{ old('nama_laki_laki') }}" name="nama_laki_laki" placeholder="Nama Calon Laki-laki.." >
                                    </div>
                                    @error('nama_laki_laki')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div> -->
                                <div class="mb-3 row">
                                  <label for="nama_laki_laki" class="col-sm-3 col-form-label">Nama Laki-laki</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama_laki_laki') is-invalid @enderror" value="{{ old('nama_laki_laki') }}" name="nama_laki_laki" placeholder="Nama Laki-laki..." >
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
                                    <input type="text" class="form-control @error('bin_binti_laki_laki') is-invalid @enderror" value="{{ old('bin_binti_laki_laki') }}" name="bin_binti_laki_laki" placeholder="Bin binti Laki-laki.." >
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
                                    <input type="text" id="alamat" class="form-control @error('alamat_laki_laki') is-invalid @enderror" value="{{ old('alamat_laki_laki') }}" name="alamat_laki_laki" placeholder="Alamat.." >
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
                                    <input type="text" class="form-control @error('nik_laki_laki') is-invalid @enderror" value="{{ old('nik_laki_laki') }}" name="nik_laki_laki" placeholder="NIK Calon Laki-laki.." >
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
                                    <input type="text" class="form-control @error('pekerjaan_laki_laki') is-invalid @enderror" value="{{ old('pekerjaan_laki_laki') }}" name="pekerjaan_laki_laki" placeholder="Pekerjaan.." >
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
                                    <input type="text" class="form-control @error('warga_negara_laki_laki') is-invalid @enderror" value="{{ old('warga_negara_laki_laki') }}" name="warga_negara_laki_laki" placeholder="Warga negara.." >
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
                                    <input type="text" class="form-control @error('tempat_lahir_laki_laki') is-invalid @enderror" value="{{ old('tempat_lahir_laki_laki') }}" name="tempat_lahir_laki_laki" placeholder="Tempat.." >
                                    <input type="date" class="form-control @error('tgl_lahir_laki_laki') is-invalid @enderror" value="{{ old('tgl_lahir_laki_laki') }}" name="tgl_lahir_laki_laki" placeholder="tgl_lahir_laki_laki.." > </div>
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
                                        <select name="agama_laki_laki" class="form-control selectx" >
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Konghucu">Konghucu</option>
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
                                            <option value="Kawin">Kawin</option>
                                            <option value="Belum Kawin">Belum Kawin</option>
                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                            <option value="Cerai Mati">Cerai Mati</option>
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
                                    <input type="text" class="form-control @error('nama_perempuan') is-invalid @enderror" value="{{ old('nama_perempuan') }}" name="nama_perempuan" placeholder="Nama Calon Perempuan.." >
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
                                    <input type="text" class="form-control @error('bin_binti_perempuan') is-invalid @enderror" value="{{ old('bin_binti_perempuan') }}" name="bin_binti_perempuan" placeholder="Bin binti Perempuan.." >
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
                                    <input type="text" class="form-control @error('alamat_perempuan') is-invalid @enderror" value="{{ old('alamat_perempuan') }}" name="alamat_perempuan" placeholder="Alamat.." >
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
                                    <input type="text" class="form-control @error('nik_perempuan') is-invalid @enderror" value="{{ old('nik_perempuan') }}" name="nik_perempuan" placeholder="NIK Calon Perempuan.." >
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
                                    <input type="text" class="form-control @error('pekerjaan_perempuan') is-invalid @enderror" value="{{ old('pekerjaan_perempuan') }}" name="pekerjaan_perempuan" placeholder="Pekerjaan.." >
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
                                    <input type="text" class="form-control @error('warga_negara_perempuan') is-invalid @enderror" value="{{ old('warga_negara_perempuan') }}" name="warga_negara_perempuan" placeholder="Warga negara.." >
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
                                    <input type="text" class="form-control @error('tempat_lahir_perempuan') is-invalid @enderror" value="{{ old('tempat_lahir_perempuan') }}" name="tempat_lahir_perempuan" placeholder="Tempat.." >
                                    <input type="date" class="form-control @error('tgl_lahir_perempuan') is-invalid @enderror" value="{{ old('tgl_lahir_perempuan') }}" name="tgl_lahir_perempuan" placeholder="tgl_lahir_perempuan.." >
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
                                    <select name="agama_perempuan" class="form-control selectx" >
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
                                <label for="status_perkawinan_perempuan" class="col-sm-3 col-form-label">Status Perkawinan</label>
                                <div class="col-sm-9">
                                    <select name="status_perkawinan_perempuan" class="form-control selectx" >
                                        <!-- <option value="Kawin">Kawin</option> -->
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </div>
                                @error('status_perkawinan_perempuan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                             <button class="btn btn-success" id="perempuan_next" type="button">Kirim</button>
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
    $("#laki_next").on('click', function () {
        var tgl_lahir_laki_laki = $("input[name='tgl_lahir_laki_laki']").val();
        var currentDate = new Date();

        var dob = new Date(tgl_lahir_laki_laki);
        var age = currentDate.getFullYear() - dob.getFullYear();

        if (currentDate.getMonth() < dob.getMonth() || (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
            age--;
        }

        var nik_laki_laki = $("input[name='nik_laki_laki']").val();

    // Validate nik_laki_laki
    if (/^\d{16}$/.test(nik_laki_laki)) {
        if (age >= 17) {
            $("#profile").addClass('active show');
            $("#home").removeClass('show active');
            $("[data-bs-target='#profile']").addClass('active show');
            $("[data-bs-target='#home']").removeClass('active show');
            $("input[name='tgl_lahir_laki_laki']").removeClass('is-invalid');
            $("#error-tgl-laki").html(' ');

            return;
        }

        $("input[name='tgl_lahir_laki_laki']").addClass('is-invalid');
        $("input[name='nik_laki_laki']").removeClass('is-invalid');
        $("#error-tgl-laki").html(
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            <li>Tanggal lahir laki-laki kurang dari 17 tahun</li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
            );
        $("html, body").animate({ scrollTop: 0 });
    } else {
        // Display error for invalid nik_laki_laki
        // You can customize this part based on your requirements
        $("input[name='nik_laki_laki']").addClass('is-invalid');
        $("#error-tgl-laki").html(
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            <li>Nomor Induk Kependudukan harus terdiri dari 16 digit angka</li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
            );

        $("html, body").animate({ scrollTop: 0 });
    }
});



    $("#perempuan_next").on('click',function(){
        var tgl_lahir_perempuan = $("input[name='tgl_lahir_perempuan']").val();
        var currentDate = new Date();

        var dob = new Date(tgl_lahir_perempuan);
        var age = currentDate.getFullYear() - dob.getFullYear();

        if (currentDate.getMonth() < dob.getMonth() || (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
            age--;
        }
        var nik_perempuan = $("input[name='nik_perempuan']").val();

    // Validate nik_perempuan
    if (/^\d{16}$/.test(nik_perempuan)) {
        if (age >= 17) {

            // $("#contact").addClass('active')
            // $("#contact").addClass('show')
            // $("#profile").removeClass('show')
            // $("#profile").removeClass('active')

            // $("[data-bs-target='#contact']").addClass('active');
            // $("[data-bs-target='#contact']").addClass('show');
            // $("[data-bs-target='#profile']").removeClass('active');
            // $("[data-bs-target='#profile']").removeClass('show');

            $("input[name='tgl_lahir_perempuan']").removeClass('is-invalid');
            $("#error-tgl-laki").html(' ')
            $("#recomendation_form").submit();
            return;
        }
        $("input[name='tgl_lahir_perempuan']").addClass('is-invalid');
        $("input[name='nik_perempuan']").removeClass('is-invalid');
        $("#error-tgl-laki").html(
            ` <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            <li>Tanggal lahir perempuan kurang dari 17 tahun</li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
            )
        $("html, body").animate({ scrollTop: 0 });
    } else {
        $("input[name='nik_perempuan']").addClass('is-invalid');
        $("#error-tgl-laki").html(
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            <li>Nomor Induk Kependudukan harus terdiri dari 16 digit angka</li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
            );

        $("html, body").animate({ scrollTop: 0 });
    }
})

    $("#permohonan").on('change',function(){
        const value=JSON.parse($(this).val());
        console.log(value)
        console.log(value.nama)
        $("#nama_laki_laki").val(value.nama)
        $("#alamat").val(value.alamat)
    })
</script>
@endpush

