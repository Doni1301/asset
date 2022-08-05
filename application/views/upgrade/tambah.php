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
			<div id="content" data-url="<?= base_url('det_soft') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('det_soft') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('det_soft/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Personal Indentifikasi Perangkat IT</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-4">
											<label>No. Input</label>
											<input type="text" name="no_input" value="SFT<?= time() ?>" readonly class="form-control">
										</div>
										<div class="form-group col-4">
											<input type="hidden" name="id_iden" class="form-control">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<h5>Data Identifikasi</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-3">
													<label for="no_iden">No Identifikasi</label>
													<select name="no_iden" id="no_iden" class="form-control">
														<option value="">Pilih No Identifikasi</option>
														<?php foreach ($all_identifikasi as $identifikasi): ?>
															<option value="<?= $identifikasi->no_iden ?>"><?= $identifikasi->no_iden ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-2">
													<label>Nama User</label>
													<input type="text" name="nama" value="" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Kode User</label>
													<input type="text" name="kode" value="" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Departement</label>
													<input type="text" name="dept" value="" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>PIC</label>
													<input type="text" name="pic" value="" readonly class="form-control">
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<h5>Data Input</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-3">
													<label for="komponen">Komponen</label>
													<select name="komponen" id="komponen" class="form-control">
														<option value="">Pilih Komponen</option>
														<?php foreach ($all_software as $software): ?>
															<option value="<?= $software->nama ?>"><?= $software->nama ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-3">
													<label>Merk/Type/Model</label>
													<input type="text" name="keterangan" value="" class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Serial Key</label>
													<input type="text" name="produk" value="" class="form-control">
												</div>
												<div class="form-group col-3">
													<label>Vendor</label>
													<input type="text" name="vendor" value="" class="form-control">
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Pengembalian</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td>Komponen</td>
													<td>Keterangan</td>
													<td>Produk</td>
													<td>Vendor</td>
													<td>Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="7" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
										</table>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			$('#no_iden').on('change', function(){
				console.log($(this).val());
				if($(this).val() == '') reset()
				else {
					const url_get_all_identifikasi = $('#content').data('url') + '/get_all_identifikasi'
					$.ajax({
						url: url_get_all_identifikasi,
						type: 'POST',
						dataType: 'json',
						data: {no_iden: $(this).val()},
						success: function(data){
							$('input[name="id_iden"]').val(data.id)
							$('input[name="nama"]').val(data.nama)
							$('input[name="kode"]').val(data.kode)
							$('input[name="dept"]').val(data.dept)
							$('input[name="pic"]').val(data.pic)
							$('button#tambah').prop('disabled', false)
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					komponen: $('select[name="komponen"]').val(),
					keterangan: $('input[name="keterangan"]').val(),
					produk: $('input[name="produk"]').val(),	
					vendor: $('input[name="vendor"]').val(),
				}

				$.ajax({
					url: url_keranjang_barang,
					type: 'POST',
					data: data_keranjang,
					success: function(data){
						reset()

						$('table#keranjang tbody').append(data)
						$('tfoot').show()
					}
				})
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('komponen') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="komponen"]').prop('disabled', true)
				$('input[name="keterangan"]').prop('disabled', true)
				$('input[name="produk"]').prop('disabled', true)
				$('input[name="vedor"]').prop('disabled', true)
			})

			function reset(){
				$('#komponen').val('')
				$('input[name="komponen"]').val('')
				$('input[name="keterangan"]').val('')
				$('input[name="produk"]').val('')
				$('input[name="vendor"]').val('')
				$('button#tambah').prop('enable', true)
			}
		})
	</script>
</body>
</html>