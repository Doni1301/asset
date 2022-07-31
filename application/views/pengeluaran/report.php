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
			<h3 class="h3 text-dark"><?= $title ?></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>No Keluar</td>
					<td>Nama Pengguna</td>
					<td>Kode Pengguna</td>
					<td>Tanggal Keluar</td>
					<td>Jam Keluar</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_pengeluaran as $keluar): ?>
					<tr>
						<td><?= $keluar->no_keluar ?></td>
						<td><?= $keluar->nama_petugas ?></td>
						<td><?= $keluar->kode_petugas ?></td>
						<td><?= $keluar->tgl_keluar ?></td>
						<td><?= $keluar->jam_keluar ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>