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
					<td>Kode Sub-Komponen</td>
					<td>Nama Sub-Komponen</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_sub as $sub): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $sub->kode ?></td>
					<td><?= $sub->nama ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>