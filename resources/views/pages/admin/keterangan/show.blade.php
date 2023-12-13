<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SURAT KETERANGAN NIKAH TIDAK TERCATAT</title>
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

		h2,h4{
			line-height: 25px;
			padding: 0px;
			margin: 0px;
			font-size: 20px;
		}

		p.text-center{
			line-height: 25px !important;
			padding: 0px !important;
			margin: 0px !important;
		}

		.text-left{
			text-align: left;
		}

		p{
			padding: 0px;
			margin: 0px;
			line-height: 20px;
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
	<div>
		<h4 style="text-decoration: underline; text-align:center;margin-top: 20px;">SURAT KETERANGAN PERNAH MENIKAH</h4>
		<p style="text-align: center;">Nomor: {{$item['no_surat']}}</p>
	</div>
	<div>
		<p>&emsp;&emsp;Yang bertanda tangan di bawah ini kami Kepala KUA Gondokusuman menerangkan bahwa:</p>
	</div>

	<div>
		<h4 style="font-size: 16px;">Suami</h4>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{$item->laki->nama}}</td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>{{$item->laki->nik}}</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td>{{$item->laki->tempat_lahir}}, {{$item->laki->tgl_lahir}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>{{$item->laki->jenis_kelamin}}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>{{$item->laki->pekerjaan}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>{{$item->laki->alamat}}</td>
			</tr>
		</table>
	</div>
	<div>
		<p>&emsp;&emsp;Bahwa pernmah menikah sya secara agama Islam dengan seorang Perempuan:</p>
	</div>
	<div>
		<h4 style="font-size: 16px;">Istri</h4>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{$item->perempuan->nama}}</td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>{{$item->perempuan->nik}}</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td>{{$item->perempuan->tempat_lahir}}, {{$item->perempuan->tgl_lahir}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>{{$item->perempuan->jenis_kelamin}}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>{{$item->perempuan->pekerjaan}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>{{$item->perempuan->alamat}}</td>
			</tr>
		</table>
	</div>
	<div>
		<p>&emsp;&emsp;Dengan ini surat keterangan ini dibuat dengan sebenarnya dan diberikan kepada yang berkepentingan untuk digunakan seperlunya.</p>
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
	// window.print()
</script>
</html>