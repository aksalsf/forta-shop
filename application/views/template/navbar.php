<nav class="navbar navbar-light bg-dark py-4">
	<div class="container-fluid">
		<a class="navbar-brand fw-bold text-white mx-auto" href="<?=base_url();?>"><?=site_name?></a>
		<form class="input-group ms-auto w-50">
			<input type="text" class="form-control shadow-none border-white" placeholder="Forta Infinity Series 8">
			<button class="btn bg-transparent border-white text-white" type="submit">
				<i class="bi bi-search"></i>
			</button>
		</form>
		<a href="<?=base_url('toko/keranjang');?>"
			class="px-3 py-1 text-white text-uppercase text-decoration-none ms-3">
			<i class="bi bi-cart4 fs-5"></i>
			<?php if($this->cart->contents() !== null): ?>
			<small class="small badge bg-danger"><?= $this->cart->total_items() ?></small>
			<?php endif; ?>
		</a>
		<nav class="ms-auto d-flex justify-content-center align-items-center px-5">
			<!-- Cek sudah login belum -->
			<?php if($this->session->userdata('pelanggan') === null): ?>
			<button type="button" data-bs-toggle="modal" data-bs-target="#masuk"
				class="btn btn-sm shadow-none px-3 py-1 border border-white rounded text-white fw-bold text-uppercase text-decoration-none me-2">
				Masuk
			</button>
			<a href="<?=base_url('toko/daftar');?>"
				class="small px-3 py-1 border border-white rounded bg-white text-dark fw-bold text-uppercase text-decoration-none">
				Daftar
			</a>
			<?php else: ?>
			<div class="d-flex">
				<div class="nav-item dropdown">
					<a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						Hai, <?= $this->session->userdata('pelanggan') -> nama ?>!
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark col-11 py-0"
						aria-labelledby="navbarDropdown">
						<li>
							<a class="dropdown-item py-3" href="<?= base_url('toko/profil') ?>">
								<i class="bi bi-person-circle me-2"></i>
								Profil
							</a>
						</li>
						<li>
							<a class="dropdown-item py-3" href="<?= base_url('toko/riwayat') ?>">
								<i class="bi bi-credit-card-2-front me-2"></i>
								Riwayat
							</a>
						</li>
						<li>
							<a class="dropdown-item py-3" href="<?= base_url('toko/logout') ?>">
								<i class="bi bi-power me-2"></i>
								Logout
							</a>
						</li>
					</ul>
				</div>
			</div>
			<?php endif; ?>
		</nav>
	</div>
</nav>
