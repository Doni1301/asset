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
					<td><strong>No Retur</strong></td>
					<td>:</td>
					<td><?= $retur->no_retur ?></td>
				</tr>
				<tr>
					<td><strong>Nama Petugas</strong></td>
					<td>:</td>
					<td><?= $retur->nama_petugas ?></td>
				</tr>
				<tr>
					<td><strong>Kode Petugas</strong></td>
					<td>:</td>
					<td><?= $retur->kode_petugas ?></td>
				</tr>
				<tr>
					<td><strong>Waktu Pengembalian</strong></td>
					<td>:</td>
					<td><?= $retur->tgl_retur ?> - <?= $retur->jam_retur ?></td>
				</tr>
				<tr>
					<td><strong>Keterangan</strong></td>
					<td>:</td>
					<td><?= $retur->keterangan ?></td>
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
					<?php foreach ($all_detail_retur as $detail_retur): ?>
						<tr>
							<td width="50"><?= $no++ ?></td>
							<td width="350"><?= $detail_retur->nama_barang ?></td>
							<td width="80" class="text-center"><?= $detail_retur->jumlah ?></td>
							<td class="text-center"> <?= strtolower($detail_retur->satuan) ?></td>
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
					<td width="200"><strong>Pengembali</strong></td>
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
					<td width="200"><u><strong><?= $retur->kode_petugas ?></u></strong></td>
					<td width="100"><u><strong>Head Of Departement</u></strong></td>
			</thead>
		</table>
	</div>
	</div>
</body>
</html>
