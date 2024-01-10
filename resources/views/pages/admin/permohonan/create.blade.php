@extends('layouts.admin')

@section('title')
Tambah Permohonan
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
							Tambah Permohonan
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
		<form action="{{ route('permohonan.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row gx-4">
				<div class="col-lg-9">
					<div class="card mb-4">
						<div class="card-header text-success">Form Permohonan</div>
						<div class="card-body">
							<div class="mb-3 row">
								<label for="id_user" class="col-sm-3 col-form-label">ID Masyarakat</label>
								<div class="col-sm-9">
									<input type="text" class="form-control @error('id_user') is-invalid @enderror" value="{{ auth()->user()->nik }}" name="id_user" placeholder="ID Masyarakat.." required readonly>
								</div>
								@error('id_user')
								<div class="invalid-feedback">
									{{ $message; }}
								</div>
								@enderror
							</div>
							<div class="mb-3 row">
								<label for="nama" class="col-sm-3 col-form-label">Nama</label>
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
								<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
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
								<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
								<div class="col-sm-9">
									<select name="jenis_kelamin" class="form-control selectx" required>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
								@error('jenis_kelamin')
								<div class="invalid-feedback">
									{{ $message; }}
								</div>
								@enderror
							</div>
							<div class="mb-3 row">
								<label for="file_permohonan" class="col-sm-3 col-form-label">File Permohonan</label>
								<div class="col-sm-9">
									<input type="file" class="form-control @error('file_permohonan') is-invalid @enderror" value="{{ old('file_permohonan') }}" accept=".pdf" name="file_permohonan" required>
									<div id="file_permohonan" class="form-text">Ekstensi .pdf</div>
								</div>
								@error('file_permohonan')
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

