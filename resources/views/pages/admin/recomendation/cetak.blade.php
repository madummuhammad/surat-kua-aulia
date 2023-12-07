<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Rekomendasi Nikah</title>
</head>
<body>
	<style>
		.d-flex{
			display: flex;
		}

		.justify-content-center{
			justify-content: center;
		}

		.justify-content-between{
			justify-content: space-between;
		}


		.justify-content-end{
			justify-content: flex-end;
		}

		.align-items-center{
			align-items: center;
		}

		.text-center{
			text-align: center;
		}

		h2{
			line-height: 25px;
			padding: 0px;
			margin: 0px;
			font-size: 20px;
		}

		p.text-center{
			line-height: 25px;
			padding: 0px;
			margin: 0px;
		}
	</style>
	<div class="d-flex justify-content-between align-items-center">
		<img style="width:150px" src="{{url('admin/assets/img/logo.png')}}" alt="">
		<div>
			<h2 class="text-center">KEMENTERIAN AGAMA REPUBLIK INDONESIA</h2>
			<h2 class="text-center">KANTOR KEMENTERIAN AGAMA KOTA YOGYAKARTA</h2>
			<h2 class="text-center">KANTOR URUSAN AGAMA KECAMATAN GONDOKUSUMAN</h2>
			<p class="text-center">Jl. Balapan No.2, Klitren, Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta</p>
			<p class="text-center">Email: kuagondokusuman@gmail.com</p>
		</div>
	</div>
	<div style="width:100%;margin-top: 10px; height: 1px;">
		<img height="2px" width="100%" src="{{url('admin/assets/img/line.png')}}" alt="">
	</div>
	<div style="margin-right: 50px;margin-top: 10px;" class="d-flex justify-content-end">
		<p>{{date('d-m-Y')}}</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>{{$item->no_surat}}</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>1 Bendel</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td>Rekomendasi Nikah</td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 10px;">
		<p>
			Kepada YTH,
		</p>
		<p>Kepala KUA Kecamatan Gondokusuman</p>
		<p>di</p>
		<p>Daerah Istimewa Yogyakarta</p>
	</div>
	<div>
		<p>&emsp;&emsp;Berdasarkan Peraturan Mentri Agama Nomor 20 Tahuan 2019 tentang Pencatatan Pernikahan, telah datang ke kantor kami seorang Perempuan:</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{$item->perempuan->nama}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>{{$item->perempuan->alamat}}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>{{$item->perempuan->pekerjaan}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>Perempuan</td>
			</tr>
			<tr>
				<td>Status Perkawinan</td>
				<td>:</td>
				<td>{{$item->perempuan->status_perkawinan}}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>{{$item->perempuan->agama}}</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td>{{$item->perempuan->tempat_lahir}}, {{$item->perempuan->tgl_lahir}}</td>
			</tr>
		</table>
	</div>
	<div>
		<p>&emsp;&emsp;Akan melaksanakan nikah di wilayah Saudara dengan seorang laki-laki</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{$item->laki->nama}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>{{$item->laki->alamat}}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>{{$item->laki->pekerjaan}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>Laki-laki</td>
			</tr>
			<tr>
				<td>Status Perkawinan</td>
				<td>:</td>
				<td>{{$item->laki->status_perkawinan}}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>{{$item->laki->agama}}</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td>{{$item->laki->tempat_lahir}}, {{$item->perempuan->tgl_lahir}}</td>
			</tr>
		</table>
	</div>
	<div>
		<p>&emsp;&emsp;Berdasarkan persyaratan yang telah ditentukan dalam PMA Nomor 20 Tahun 2019 kami lampirkan persyaratan permohonan pendaftaran kehendak pernikahan</p>
	</div>
	<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
		<div class="text-center">
			@if($item->pegawai->jabatan=='Kepala KUA')
			<p>Kepala KUA Kecamatan</p>
			@endif
			@if($item->pegawai->jabatan=='Penghulu')
			<p>Penghulu Kecamatan</p>
			@endif
			<p>GONDOKUSUMAN</p>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>{{$item->pegawai->nama}}</P>
		</div>
	</div>
</body>
<script>
	window.print()
</script>
</html>