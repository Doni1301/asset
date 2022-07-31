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
			<div id="content" data-url="<?= base_url('retur') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('retur') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
                                <form action="<?= base_url('retur/proses_edit') ?>" id="form-edit" method="POST">
                            <h5>Data Petugas</h5>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label>No. Retur</label>
                                        <input type="text" name="no_retur" value="<?= $retur->no_retur ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Kode Petugas</label>
                                        <input type="hidden" name="kode_petugas" value="<?= $this->session->login['kode'] ?>" />
                                        <input type="text" name="" value="<?= $retur->kode_petugas ?? '' ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Nama Petugas</label>
                                        <input type="hidden" name="nama_petugas" value="<?= $this->session->login['nama'] ?? '' ?>">
                                        <input type="text" name="" value="<?= $retur->nama_petugas ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Tanggal Retur</label>
                                        <input type="text" name="tgl_retur" value="<?= $retur->tgl_retur ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Jam</label>
                                        <input type="text" name="jam_retur" value="<?= $retur->jam_retur ?>" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Keterangan</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                            <label>Keterangan</label>
                                            <input type="text" name="keterangan" value="<?= $retur->keterangan ?>" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <form action="<?= base_url() ?>retur/add_detail" method="post"> -->
                                            <input type="hidden" name="no_retur" value="<?= $retur->no_retur ?>">  
                                            <h5>Data Barang</h5>
                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-4">
                                                    <label for="nama_barang">Nama Barang</label>
                                                    <select name="nama_barang" id="nama_barang" class="form-control">
                                                        <option value="">Pilih Barang</option>
                                                        <?php foreach ($all_barang as $barang): ?>
                                                            <option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Kode Barang</label>
                                                    <input type="text" name="kode_barang" readonly class="form-control">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>Jumlah</label>
                                                    <input type="number" name="jumlah" class="form-control" readonly min='1'>
                                                </div>
                                                <div class="form-group col-1">
                                                    <label for="">&nbsp;</label>
                                                    <button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <input type="hidden" name="satuan" value="">
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="keranjang">
                                    <h5>Detail Pengembalian</h5>
                                    <hr>
                                    <table class="table table-bordered" id="keranjang">
                                        <thead>
                                            <tr>
                                                <td width="35%">Nama Barang</td>
                                                <td width="15%">Kode Barang</td>
                                                <td width="15%">Jumlah</td>
                                                <td width="10%">Satuan</td>
                                                <td width="15%">Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($all_detail_retur as $key => $dRetur): ?>
                                                <tr class="row-keranjang">
                                                    <td class="nama_barang"><?= $dRetur->nama_barang ?>
                                                        <input type="hidden" name="nama_barang_hidden[]" value="<?= $dRetur->nama_barang ?>">
                                                    </td>
                                                    <td class="kode_barang"><?= $dRetur->kode_barang ?>
                                                        <input type="hidden" name="kode_barang_hidden[]" value="<?= $dRetur->kode_barang ?>">
                                                    </td>
                                                    <td class="jumlah"><?= $dRetur->jumlah ?>
                                                        <input type="hidden" name="jumlah_hidden[]" value="<?= $dRetur->jumlah ?>">
                                                    </td>
                                                    <td class="satuan"><?= $dRetur->satuan ?>
                                                        <input type="hidden" name="satuan_hidden[]" value="<?= $dRetur->satuan ?>">
                                                    </td>
                                                    <td class="aksi">
                                                        <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $dRetur->nama_barang ?>"><i class="fa fa-trash"></i></button>
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

			$('#nama_barang').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {nama_barang: $(this).val()},
                        cache: false,
						success: function(data){
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="harga_barang"]').val(data.harga_jual)
							$('input[name="jumlah"]').val(1)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})

            $(document).on('click', '#tambah', function(e){
                const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
                const data_keranjang = {
                    nama_barang: $('select[name="nama_barang"]').val(),
                    kode_barang: $('input[name="kode_barang"]').val(),
                    jumlah: $('input[name="jumlah"]').val(),
                    satuan: $('input[name="satuan"]').val(),
                }

                $.ajax({
                    url: url_keranjang_barang,
                    type: 'POST',
                    data: data_keranjang,
                    success: function(data){
                        if($('select[name="nama_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
                        reset()

                        $('table#keranjang tbody').append(data)
                        $('tfoot').show()

                        $('#total').html('<strong>' + hitung_total() + '</strong>')
                        $('input[name="total_hidden"]').val(hitung_total())
                    }
                })
            })

            var detail_pengembalian = $( "table#keranjang tbody" ).find("button[data-nama-barang]");
            detail_pengembalian.each(function(i){
                    $('option[value="' + $(this).data('nama-barang') + '"]').hide()
            });

            $(document).on('click', '#tombol-hapus', function(){
                $(this).closest('.row-keranjang').remove()

                $('option[value="' + $(this).data('nama-barang') + '"]').show()

                if($('tbody').children().length == 0) $('tfoot').hide()
            })

            $('button[type="submit"]').on('click', function(){
                $('input[name="kode_barang"]').prop('disabled', true)
                $('select[name="nama_barang"]').prop('disabled', true)
                $('input[name="satuan"]').prop('disabled', true)
                $('input[name="jumlah"]').prop('disabled', true)
            })

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#nama_barang').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>