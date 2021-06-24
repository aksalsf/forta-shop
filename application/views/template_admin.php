<!--
    Template untuk halaman Admin
 -->

<?php $this->load->view('template/header');?>
<?php if ($this->session->flashdata('notifikasi')) $this->load->view('template/notifikasi'); ?>

<div class="d-flex align-items-stretch min-vh-100 bg-light">
	<?php $this->load->view('template/sidebar');?>
	<?php $this->load->view('template/container', $content);?>
</div>

<?php $this->load->view('template/footer');
