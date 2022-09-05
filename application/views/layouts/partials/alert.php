<?php if($this->session->flashdata('success')) : ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'Sukses',
		text:'<?= $this->session->flashdata('success') ?>',
		showConfirmButton: true,
		timer: 1500
	})
</script>
<?php elseif($this->session->flashdata('error')) : ?>
	<script>
	Swal.fire({
		icon: 'error',
		title: 'Gagal',
		text:'<?= $this->session->flashdata('error') ?>',
		showConfirmButton: true,
		timer: 1500
	})
</script>
<?php endif; ?>
