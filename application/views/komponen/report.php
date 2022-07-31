<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>No</td>
					<td>Kode Komponen</td>
					<td>Nama Komponen</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_komponen as $komponen): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $komponen->kode ?></td>
					<td><?= $komponen->nama ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>