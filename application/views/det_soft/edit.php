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
                                <form action="<?= base_url('det_soft/proses_edit') ?>" id="form-edit" method="POST" class="form-disable">
                            <h5>Data Identifikasi Lisensi</h5>
                                <hr>
                                <div class="form-row">
									<div class="form-group col-2">
										<label>No. Input</label>
										<input type="text" name="no_input" value="<?= $det_soft->no_input?>" readonly class="form-control">
									</div>
								</div>
                                <br>
									<div class="row">
										<div class="col-md-12">
											<h5>Data User</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-4">
													<label for="nama">Nama User</label>
													<input type="text" name="nama" value="<?= $det_soft->nama ?>" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Kode User</label>
													<input type="text" name="kode" value="<?= $det_soft->kode ?>" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>Departement</label>
													<input type="text" name="dept" value="<?= $det_soft->dept ?>" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>PIC</label>
													<input type="text" name="pic" value="<?= $det_soft->pic ?>" readonly class="form-control">
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
												<div class="form-group col-2">
													<label for="komponen">Komponen</label>
													<select name="komponen" id="komponen" class="form-control">
														<option value="">Pilih Komponen</option>
														<?php foreach ($all_software as $software): ?>
															<option value="<?= $software->nama ?>"><?= $software->nama ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-2">
													<label>No Identifikasi</label>
													<input type="text" name="no_iden" value="<?= $det_soft->no_iden ?>" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Keterangan</label>
													<input type="text" name="keterangan" value="" class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Produk</label>
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
											<td>Komponen</td>
											<td>No Identifikasi</td>
											<td>Keterangan</td>
											<td>Produk</td>
											<td>Vendor</td>
                                        </thead>
                                        <tbody>
                                            <?php foreach($all_detail_soft as $key => $detsoft): ?>
                                                <tr class="row-keranjang">
                                                    <td class="komponen"><?= $detsoft->komponen ?>
                                                        <input type="hidden" name="nama_barang_hidden[]" value="<?= $detsoft->komponen ?>">
                                                    </td>
                                                    <td class="no_iden"><?= $detsoft->no_iden ?>
                                                        <input type="hidden" name="kode_barang_hidden[]" value="<?= $detsoft->no_iden ?>">
                                                    </td>
                                                    <td class="keterangan"><?= $detsoft->keterangan ?>
                                                        <input type="hidden" name="jumlah_hidden[]" value="<?= $detsoft->keterangan ?>">
                                                    </td>
                                                    <td class="produk"><?= $detsoft->produk ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $detsoft->produk ?>">
                                                    </td>
                                                    <td class="vendor"><?= $detsoft->vendor ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $detsoft->vendor ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" align="center">
                                                    <input type="hidden" name="max_hidden" value="">
                                                    <button type="submit" class="btn btn-primary"  name="submit" disabled><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													<a href="<?= base_url('det_soft') ?>" class="btn btn-secondary"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
            // $('tfoot').hide()
           
			$(document).keypress(function(event){
		    	if (event.which == '10') {
		      		event.preventDefault();
			   	}
			})

            $('#komponen').on('change', function(){
				console.log($(this).val());
				if($(this).val() == '') reset()
				else {
					const url_get_all_iden = $('#content').data('url') + '/get_all_iden'
					$.ajax({
						url: url_get_all_iden,
						type: 'POST',
						dataType: 'json',
						data: {komponen: $(this).val()},
						success: function(data){
							$('button#tambah').prop('disabled', false)
							$('button[type="submit"]').prop('disabled', false)
						}
					})
				}
			})

            $(document).on('click', '#tambah', function(e){
                const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
                const data_keranjang = {
					komponen: $('select[name="komponen"]').val(),
					no_iden: $('input[name="no_iden"]').val(),
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

            $('button[type="submit"]').on('click', function(){
				$('input[name="komponen"]').prop('disabled', true)
				$('select[name="no_iden"]').prop('disabled', true)
				$('input[name="keterangan"]').prop('disabled', true)
				$('input[name="produk"]').prop('disabled', true)
				$('input[name="vendor"]').prop('disabled', true)
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