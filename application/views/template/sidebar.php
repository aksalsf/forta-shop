<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
	<a href="<?= base_url() ?>"
		class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
		<i class="bi bi-tablet-landscape-fill me-2 fs-4"></i>
		<span class="fs-4 fw-bold"><?=site_name?></span>
	</a>
	<hr>
	<ul class="nav nav-pills flex-column mb-auto">
		<li class="nav-item mb-2">
			<a href="<?= base_url('admin/order') ?>"
				class="nav-link text-white <?php if($this->uri->segment(2, 'index') == 'order') echo 'active' ?>">
				<i class="bi bi-shop me-2"></i>
				Order
			</a>
		</li>
		<li class="nav-item mb-2">
			<a href="<?= base_url('admin/gudang') ?>"
				class="nav-link text-white <?php if($this->uri->segment(2, 'index') == 'gudang') echo 'active' ?>">
				<i class="bi bi-box-seam me-2"></i>
				Gudang
			</a>
		</li>
		<li class="nav-item mb-2">
			<a href="<?= base_url('admin/brand') ?>"
				class="nav-link text-white <?php if($this->uri->segment(2, 'index') == 'brand') echo 'active' ?>">
				<i class="bi bi-gem me-2"></i>
				Brand
			</a>
		</li>
		<li class="nav-item mb-2">
			<a href="<?= base_url('admin/pelanggan') ?>"
				class="nav-link text-white <?php if($this->uri->segment(2, 'index') == 'pelanggan') echo 'active' ?>">
				<i class="bi bi-person-circle me-2"></i>
				Pelanggan
			</a>
		</li>
	</ul>
	<hr>
	<a href="<?= base_url('admin/logout') ?>" class="nav-link text-white">
		<i class="bi bi-power me-2"></i>
		Logout
	</a>
</div>
