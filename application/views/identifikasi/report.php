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
					<td>Nomer Identifikasi</td>
					<td>Tanggal Identifikasi</td>
					<td>Jam Identifikasi</td>
					<td>Nama User</td>
					<td>Koder User</td>
					<td>Departement</td>
					<td>PIC</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_identifikasi as $identifikasi): ?>
					<tr>
						<td><?= $identifikasi->no_iden ?></td>
						<td><?= $identifikasi->tgl_iden ?></td>
						<td><?= $identifikasi->jam_iden ?></td>
						<td><?= $identifikasi->nama ?></td>
						<td><?= $identifikasi->kode ?></td>
						<td><?= $identifikasi->dept ?></td>
						<td><?= $identifikasi->pic ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>