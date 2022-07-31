<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><center><?= $title ?></center></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>No Keluar</strong></td>
					<td>:</td>
					<td><?= $pengeluaran->no_keluar ?></td>
				</tr>
				<tr>
					<td><strong>Nama Pengguna</strong></td>
					<td>:</td>
					<td><?= $pengeluaran->nama_petugas ?></td>
				</tr>
				<tr>
					<td><strong>Nama Customer</strong></td>
					<td>:</td>
					<td><?= $pengeluaran->kode_petugas ?></td>
				</tr>
				<tr>
					<td><strong>Waktu Pengeluaran</strong></td>
					<td>:</td>
					<td><?= $pengeluaran->tgl_keluar ?> - <?= $pengeluaran->jam_keluar ?></td>
				</tr>
				<tr>
					<td><strong>Keterangan</strong></td>
					<td>:</td>
					<td><?= $pengeluaran->keterangan ?></td>
				</tr>
			</table>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td><strong>No</strong></td>
						<td><strong>Nama Barang</strong></td>
						<td><strong>Jumlah</strong></td>
						<td><strong>Satuan</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_detail_keluar as $detail_keluar): ?>
						<tr>
							<td width="50"><?= $no++ ?></td>
							<td width="350"><?= $detail_keluar->nama_barang ?></td>
							<td width="80" class="text-center"><?= $detail_keluar->jumlah ?></td>
							<td class="text-center"> <?= strtolower($detail_keluar->satuan) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<td width="200"></td>
					<td width="200"><strong>Pengambil</strong></td>
					<td width="100"><strong>Mengetahui</strong></td>
			</thead>
		</table>
	</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<td width="200"></td>
					<td width="200"><u><strong><?= $pengeluaran->kode_petugas ?></u></strong></td>
					<td width="100"><u><strong>Head Of Departement</u></strong></td>
			</thead>
		</table>
	</div>
	</div>
</body>
</html>
