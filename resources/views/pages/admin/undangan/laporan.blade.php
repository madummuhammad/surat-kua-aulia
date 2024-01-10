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
	<div>
		<h3 style="text-align: center;">Laporan Undangan</h3>
	</div>
</body>
<style>
	table{
		width: 100%;
		border: 1px solid black;
		border-collapse: collapse;
	}

	table tr{
		border: 1px solid black;
		padding: 5px;
	}

	table tr td,table tr th{
		padding: 5px;
		border: 1px solid black;
	}
</style>
<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Nomor Undangan</th>
			<th>Perihal</th>
			<th>Sifat</th>
		</tr>
	</thead>
	<tbody>
		@php
		$no=1;
		@endphp
		@foreach($item as $item)
		<tr>
			<td>
				{{$no++}}
			</td>
			<td>
				{{$item->no_undangan}}
			</td>
			<td>
				{{$item->perihal}}
			</td>
			<td>
				{{$item->sifat}}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div style="margin-right: 50px;margin-top: 20px;" class="d-flex justify-content-end">
	<div class="text-center">			
		<p class="fw-bold">Kepala KUA Kecamatan</p>
		<p class="fw-bold">GONDOKUSUMAN</p>
		<P>&emsp;</P>
		<P class="fw-bold">{{$pegawai->nama}}</P>
	</div>
</div>
<script>
	window.print()
</script>
</html>