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
			<div id="content" data-url="<?= base_url('identifikasi') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('identifikasi') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
                                <form action="<?= base_url('identifikasi/proses_edit') ?>" id="form-edit" method="POST">
                            <h5>Data Identifikasi</h5>
                                <hr>
                                <div class="form-row">
									<div class="form-group col-2">
										<label>No. Identifikasi</label>
										<input type="text" name="no_iden" value="<?= $identifikasi->no_iden?>" readonly class="form-control">
									</div>
									<div class="form-group col-2">
										<label>Tanggal Identifikasi</label>
										<input type="text" name="tgl_iden" value="<?= $identifikasi->tgl_iden?>" readonly class="form-control">
									</div>
									<div class="form-group col-2">
										<label>Jam</label>
										<input type="text" name="jam_iden" value="<?= $identifikasi->jam_iden?>" readonly class="form-control">
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
													<input type="text" name="nama" value="<?= $identifikasi->nama ?>" readonly class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Kode User</label>
													<input type="text" name="kode" value="<?= $identifikasi->kode ?>" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>Departement</label>
													<input type="text" name="dept" value="<?= $identifikasi->dept ?>" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>PIC</label>
													<input type="text" name="pic" value="<?= $identifikasi->pic ?>" readonly class="form-control">
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
														<?php foreach ($all_komponen as $komponen): ?>
															<option value="<?= $komponen->nama ?>"><?= $komponen->nama ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-2">
													<label for="sub">Sub Komponen</label>
													<select name="sub" id="sub" class="form-control">
														<option value="">Pilih Sub Komponen</option>
														<?php foreach ($all_sub as $sub): ?>
															<option value="<?= $sub->nama ?>"><?= $sub->nama ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-2">
													<label>Merk/Type/Model</label>
													<input type="text" name="keterangan" value="" class="form-control">
												</div>
												<div class="form-group col-2">
													<label>Serial Number</label>
													<input type="text" name="sn" value="" class="form-control">
												</div>
												<div class="form-group col-1">
													<label>Exp Garansi</label>
													<input type="text" name="exp" value="" class="form-control">
												</div>
												<div class="form-group col-2">
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
												<td>Sub Komponen</td>
												<td>Keterangan</td>
												<td>Serial Number</td>
												<td>Exp Garansi</td>
												<td>Vendor</td>
												<td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($all_detail_iden as $key => $diden): ?>
                                                <tr class="row-keranjang">
                                                    <td class="komponen"><?= $diden->komponen ?>
                                                        <input type="hidden" name="nama_barang_hidden[]" value="<?= $diden->komponen ?>">
                                                    </td>
                                                    <td class="sub"><?= $diden->sub ?>
                                                        <input type="hidden" name="kode_barang_hidden[]" value="<?= $diden->sub ?>">
                                                    </td>
                                                    <td class="keterangan"><?= $diden->keterangan ?>
                                                        <input type="hidden" name="jumlah_hidden[]" value="<?= $diden->keterangan ?>">
                                                    </td>
                                                    <td class="sn"><?= $diden->sn ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $diden->sn ?>">
                                                    </td>
                                                    <td class="exp"><?= $diden->exp ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $diden->exp ?>">
                                                    </td>
                                                    <td class="vendor"><?= $diden->vendor ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $diden->vendor ?>">
                                                    </td>
                                                    <td class="aksi">
                                                        <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-komponen="<?= $diden->komponen ?>"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" align="center">
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
            // $('tfoot').hide()
           
			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

            $('#nama').on('change', function(){
				console.log($(this).val());
				if($(this).val() == '') reset()
				else {
					const url_get_all_user = $('#content').data('url') + '/get_all_user'
					$.ajax({
						url: url_get_all_user,
						type: 'POST',
						dataType: 'json',
						data: {nama: $(this).val()},
						success: function(data){
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
					sub: $('select[name="sub"]').val(),
					keterangan: $('input[name="keterangan"]').val(),
					sn: $('input[name="sn"]').val(),
					exp: $('input[name="exp"]').val(),	
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

            var detail_iden = $( "table#keranjang tbody" ).find("button[data-nama-komponen]");
            detail_iden.each(function(i){
                    $('option[value="' + $(this).data('nama-komponen') + '"]').hide()
            });

            $(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('komponen').data('sub') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

            $('button[type="submit"]').on('click', function(){
				$('input[name="komponen"]').prop('disabled', true)
				$('select[name="sub"]').prop('disabled', true)
				$('input[name="keterangan"]').prop('disabled', true)
				$('input[name="sn"]').prop('disabled', true)
				$('input[name="exp"]').prop('disabled', true)
				$('input[name="vedor"]').prop('disabled', true)
			})

			function reset(){
				$('#komponen').val('')
				$('#sub').val('')
				$('input[name="komponen"]').val('')
				$('input[name="sub"]').val('')
				$('input[name="keterangan"]').val('')
				$('input[name="sn"]').val('')
				$('input[name="exp"]').val('')
				$('input[name="vendor"]').val('')
				$('button#tambah').prop('enable', true)
			}
		})
	</script>
</body>
</html>