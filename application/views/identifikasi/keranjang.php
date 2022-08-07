<tr class="row-keranjang">
	<td class="id_iden">
		<?= $this->input->post('id_iden') ?>
		<input type="hidden" name="id_iden_hidden[]" value="<?= $this->input->post('id_iden') ?>">
	</td>
	<td class="komponen">
		<?= $this->input->post('komponen') ?>
		<input type="hidden" name="komponen_hidden[]" value="<?= $this->input->post('komponen') ?>">
	</td>
	<td class="sub">
		<?= $this->input->post('sub') ?>
		<input type="hidden" name="sub_hidden[]" value="<?= $this->input->post('sub') ?>">
	</td>
	<td class="keterangan">
		<?= $this->input->post('keterangan') ?>
		<input type="hidden" name="keterangan_hidden[]" value="<?= $this->input->post('keterangan') ?>">
	</td>
	<td class="sn">
		<?= $this->input->post('sn') ?>
		<input type="hidden" name="sn_hidden[]" value="<?= $this->input->post('sn') ?>">
	</td>
	<td class="exp">
		<?= $this->input->post('exp') ?>
		<input type="hidden" name="exp_hidden[]" value="<?= $this->input->post('exp') ?>">
	</td>
	<td class="vendor">
		<?= $this->input->post('vendor') ?>
		<input type="hidden" name="vendor_hidden[]" value="<?= $this->input->post('vendor') ?>">
	</td>
</tr>