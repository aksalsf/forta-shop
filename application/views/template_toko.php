<?php

/**
 * Template untuk Halaman Toko
 */

$this->load->view('template/header');
?>

<div class="bg-light">
	<?php $this->load->view('template/navbar'); ?>
	<?= $content ?>
</div>

<?php $this->load->view('template/footer');
