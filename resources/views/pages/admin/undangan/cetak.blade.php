@if($item->perihal=='Surat Permintaan Buku Nikah dan Akta Nikah')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Undangan</title>
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

		.fw-bold{
			font-weight: bold;
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
		<p>{{$item['tanggal']}}</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>{{$item->no_undangan}}</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>{{$item->lampiran}}</td>
			</tr>
			<tr>
				<td>Sifat</td>
				<td>:</td>
				<td>{{$item->sifat}}</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td class="fw-bold">{{$item->perihal}}</td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 10px;">
		<p class="fw-bold">
			&emsp;&emsp;Kepada,
		</p>
		<p class="fw-bold">
			&emsp;&emsp;{{$item->kepada}},
		</p>
		<p class="fw-bold">&emsp;&emsp;Di -</p>
		<p class="fw-bold">&emsp;&emsp;Tempat</p>
	</div>
	<div>
		<p class="fw-bold">Assalamualaikum Warrahmatullahi Wabarakatuh</p>
		<p>&emsp;&emsp;Berhubungan persediaan stok Buku Nikah dan Akta Nikah Yang ada di Kantor Urusan Agama Kecamatan Gondokusuman saat ini sudah habis, untuk itu kami mohon di berikan <span class="fw-bold">Buku Nikah sebanyak 300 Pasang dan Akta Nikah sebanyak 300 Lembar.</span>:</p>
		<p>Demikian atas perhatian dan kerjasamanya kami sampaikan terimakasih</p>
		<p class="fw-bold">Wassalamualaikum Warrahmatullahi Wabarakatuh</p>
	</div>
<!-- 	<div>
		<table>
			<tr>
				<td>Pada hari/tanggal</td>
				<td>:</td>
				<td>{{$item->pada}}</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>:</td>
				<td>{{$item->waktu}}</td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td>:</td>
				<td>{{$item->tempat}}</td>
			</tr>
			<tr>
				<td>Acara</td>
				<td>:</td>
				<td>{{$item->acara}}</td>
			</tr>
		</table>
	</div> -->
<!-- 	<div>
		<p>Demikian undangan ini kami sampaikan, atas kerjasamanya dan kehadiranya tepat waktu kami ucapkan terima kasih.</p>
		<p class="fw-bold">Wassalamualaikum Warrahmatullahi Wabarakatuh</p>
	</div> -->
	<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
		<div class="text-center">			
			@if($item->pegawai->jabatan=='Kepala KUA')
			<p class="fw-bold">Kepala KUA Kecamatan</p>
			@endif
			@if($item->pegawai->jabatan=='Penghulu')
			<p class="fw-bold">Penghulu Kecamatan</p>
			@endif
			<p class="fw-bold">GONDOKUSUMAN</p>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P class="fw-bold">{{$item->pegawai->nama}}</P>
		</div>
	</div>
</body>
<script>
	window.print()
</script>
</html>
@endif

@if($item->perihal=='Surat pemberitahuan nasehat / bimbingan perkawinan')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Undangan</title>
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

		.fw-bold{
			font-weight: bold;
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
		<p>{{$item['tanggal']}}</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>{{$item->no_undangan}}</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>{{$item->lampiran}}</td>
			</tr>
			<tr>
				<td>Sifat</td>
				<td>:</td>
				<td>{{$item->sifat}}</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td class="fw-bold">{{$item->perihal}}</td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 10px;">
		<p class="fw-bold">
			&emsp;&emsp;Yth. Saudara/i {{$item->kepada}}
		</p>
		<p class="fw-bold">&emsp;&emsp;Di -</p>
		<p class="fw-bold">&emsp;&emsp;Tempat</p>
	</div>
	<div>
		<p class="fw-bold">Assalamualaikum Warrahmatullahi Wabarakatuh</p>
		<p>&emsp;&emsp;Kepala Kantor Urusan Agama Kecamatan Gondokusuman, dengan ini mengundang saudara/i untuk hadir :</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Pada hari/tanggal</td>
				<td>:</td>
				<td>{{$item->pada}}</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>:</td>
				<td>{{$item->waktu}}</td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td>:</td>
				<td>{{$item->tempat}}</td>
			</tr>
			<tr>
				<td>Acara</td>
				<td>:</td>
				<td>{{$item->acara}}</td>
			</tr>
		</table>
	</div>
	<div>
		<p>Demikian undangan ini kami sampaikan, atas kerjasamanya dan kehadiranya tepat waktu kami ucapkan terima kasih.</p>
		<p class="fw-bold">Wassalamualaikum Warrahmatullahi Wabarakatuh</p>
	</div>
	<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
		<div class="text-center">			
			@if($item->pegawai->jabatan=='Kepala KUA')
			<p class="fw-bold">Kepala KUA Kecamatan</p>
			@endif
			@if($item->pegawai->jabatan=='Penghulu')
			<p class="fw-bold">Penghulu Kecamatan</p>
			@endif
			<p class="fw-bold">GONDOKUSUMAN</p>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P class="fw-bold">{{$item->pegawai->nama}}</P>
		</div>
	</div>
</body>
<script>
	window.print()
</script>
</html>
@endif

@if($item->perihal=='Surat pemberitahuan kekurangan syarat pernikahan')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Undangan</title>
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

		.fw-bold{
			font-weight: bold;
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
	<div style="padding-left: 25%; padding-right: 25%; margin-bottom: 20px;">
		<div>
			Lampiran V1
		</div>
		<div>Keputusan Dirjen Bimas Islam Nomor 713</div>
		<div>Lampiran V</div>
		<div>Keputusan Dirjen Bimas Islam Nomor 713</div>
		<div>Tahun 2018 tentang</div>
		<div>Penetapan formulir dan Laporan Pencatatan Perkawinan atau Rujuk</div>
	</div>
	<div class="d-flex justify-content-center
	align-items-center">
	<div>
		<h2 class="text-center">KANTOR URUSAN AGAMA</h2>
		<h2 class="text-center">KECAMATAN GONDOKUSUMAN</h2>
		<h2 class="text-center" style="text-decoration: underline;">KABUPATEN SLEMAN</h2>
	</div>
</div>
<div style="width:100%;margin-top: 10px; height: 1px;">
	<img height="2px" width="100%" src="{{url('admin/assets/img/line.png')}}" alt="">
</div>
<div style="margin-right: 50px;margin-top: 10px;" class="d-flex justify-content-end">
	<p>{{$item['tanggal']}}</p>
</div>
<div>
	<table>
		<tr>
			<td>Nomor</td>
			<td>:</td>
			<td>{{$item->no_undangan}}</td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td>{{$item->lampiran}}</td>
		</tr>
		<tr>
			<td>Sifat</td>
			<td>:</td>
			<td>{{$item->sifat}}</td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td class="fw-bold">{{$item->perihal}}</td>
		</tr>
	</table>
</div>
<div style="margin-top: 10px;">
	<p class="fw-bold">
		&emsp;&emsp;Kepada Yth,
	</p>
	<p class="fw-bold">
		&emsp;&emsp;Saudara/i {{$item->kepada}},
	</p>
	<p class="fw-bold">&emsp;&emsp;Di -</p>
	<p class="fw-bold">&emsp;&emsp;Tempat</p>
</div>
<div>
	<p class="fw-bold">Assalamualaikum Warrahmatullahi Wabarakatuh</p>
	<p>&emsp;&emsp;Dengan hormat, setelah dilakukan pemeriksaan terhadap persyaratan pendaftaran perkawinan yang diatur dalam peraturan perundang-undangan bahwa permohonan pendaftaran perkawinan Saudari ............................... dengan Saudara .............................. diberitahukan sebagai berikut :</p>
</div>
	<div>
		<ul>
			<li>Perkawinan dapat dilaksanakan dengan melengkapi persyaratan <span class="fw-bold">Keputusan Pengadilan Agama tentang Dispensasi Umur bagi Calon Pengantin Perempuan An .............</span></li>
			<li>
				Tidak dapat dilaksanakan (ditalok) karena tidak melengkapi persyaratan berupa <span class="fw-bold">keputusan Pengadilan Agama tentang Dispensasi Umur untuk Calon Pengantin Perempuan</span> yang masih di bawah 19 tahun
			</li>
		</ul>
	</div>
	<div>
		<p>Demikian agar menjadi maklum</p>
		<p class="fw-bold">Wassalamualaikum Warrahmatullahi Wabarakatuh</p>
	</div>
	<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
		<div class="text-center">			
			@if($item->pegawai->jabatan=='Kepala KUA')
			<p class="fw-bold">Kepala KUA Kecamatan</p>
			@endif
			@if($item->pegawai->jabatan=='Penghulu')
			<p class="fw-bold">Penghulu Kecamatan</p>
			@endif
			<p class="fw-bold">GONDOKUSUMAN</p>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P class="fw-bold">{{$item->pegawai->nama}}</P>
		</div>
	</div>
</body>
<script>
	window.print()
</script>
</html>
@endif