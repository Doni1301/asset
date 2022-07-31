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
			<div id="content" data-url="<?= base_url('user') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode"><strong>Kode User</strong></label>
											<input type="text" name="kode" placeholder="Masukkan Kode" autocomplete="off"  class="form-control" required value="bwk-user-<?= mt_rand(1000, 9999) ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama"><strong>Nama User</strong></label>
											<input type="text" name="nama" placeholder="Masukkan Nama" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="dept"><strong>Departement</strong></label>
											<input type="text" name="dept" placeholder="Masukkan Departement" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="pic"><strong>PIC</strong></label>
											<input type="text" name="pic" placeholder="Masukkan PIC" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="email"><strong>Email</strong></label>
											<input type="text" name="email" placeholder="Masukkan Email" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
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
</body>
</html>