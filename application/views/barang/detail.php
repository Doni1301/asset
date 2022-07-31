<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
					<div class="card-header"><strong><?= $title ?> - <?= $barang->kode_barang ?></strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-borderless">
									<tr>
										<td><strong>Kode Barang</strong></td>
										<td>:</td>
										<td><?= $barang->kode_barang ?></td>
									</tr>
									<tr>
										<td><strong>Nama Barang</strong></td>
										<td>:</td>
										<td><?= $barang->nama_barang ?></td>
									</tr>
									<tr>
										<td><strong>Stok</strong></td>
										<td>:</td>
										<td><?= $barang->stok ?></td>
									</tr>
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered" id="dataTable">
									<thead>
										<tr>
											<td><strong>No</strong></td>
											<td><strong>Tanggal</strong></td>
											<td><strong>No Transaksi</strong></td>
											<td><strong>Jenis</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td><strong>Jumlah</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($history as $key => $detail): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $detail['tanggal'] ?></td>
                                                <td><?= $detail['number'] ?></td>
												<td><?= $detail['type'] ?></td>
												<td><?= $detail['barang'] ?></td>
												<td><?= $detail['jumlah'] ?></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>