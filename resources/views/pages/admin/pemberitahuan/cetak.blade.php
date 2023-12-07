<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pemberitahuan Kekurangan Syarat Perkawinan</title>
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
		<p>{{$item['tanggal']}}</p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>{{$item['no_surat']}}</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>1 Bendel</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td>Pemberitahuan kekurangan syarat perkawinan</td>
			</tr>
		</table>
	</div>
	<div style="margin-top: 10px;">
		<p>
			Kepada YTH,
		</p>
		<p style="font-weight:bold">Saudara/i {{$item['kepada']}}</p>
		<p>di Daerah Istimewa Yogyakarta</p>
	</div>
	<div>
		@php
		echo $item['isi_surat'];
		@endphp
	</div>
	<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
		<div class="text-center">			
			<p>Kepala KUA Kecamatan</p>
			<p>GONDOKUSUMAN</p>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>&emsp;</P>
			<P>-------------------------</P>
		</div>
	</div>
</body>
<script>
	window.print()
</script>
</html>