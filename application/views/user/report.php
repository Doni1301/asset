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
					<td>Kode User</td>
					<td>Nama User</td>
					<td>Departement</td>
					<td>PIC</td>
					<td>Email</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_user as $user): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $user->kode ?></td>
					<td><?= $user->nama ?></td>
					<td><?= $user->dept ?></td>
					<td><?= $user->pic ?></td>
					<td><?= $user->email ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>