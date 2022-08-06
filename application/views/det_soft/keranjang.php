<tr class="row-keranjang">
	<td class="komponen">
		<?= $this->input->post('komponen') ?>
		<input type="hidden" name="komponen_hidden[]" value="<?= $this->input->post('komponen') ?>">
	</td>
	<td class="no_iden">
		<?= $this->input->post('no_iden') ?>
		<input type="hidden" name="no_iden_hidden[]" value="<?= $this->input->post('no_iden') ?>">
	</td>
	<td class="keterangan">
		<?= $this->input->post('keterangan') ?>
		<input type="hidden" name="keterangan_hidden[]" value="<?= $this->input->post('keterangan') ?>">
	</td>
	<td class="produk">
		<?= $this->input->post('produk') ?>
		<input type="hidden" name="produk_hidden[]" value="<?= $this->input->post('produk') ?>">
	</td>
	<td class="vendor">
		<?= $this->input->post('vendor') ?>
		<input type="hidden" name="vendor_hidden[]" value="<?= $this->input->post('vendor') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('komponen') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>