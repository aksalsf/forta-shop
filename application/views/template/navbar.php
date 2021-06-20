<nav class="navbar navbar-light bg-dark py-4">
	<div class="container-fluid">
		<a class="navbar-brand fw-bold text-white mx-auto" href="<?=base_url();?>"><?=site_name?></a>
		<form class="input-group ms-auto w-50">
			<input type="text" class="form-control shadow-none border-white" placeholder="Forta Infinity Series 8">
			<button class="btn bg-transparent border-white text-white" type="submit">
				<i class="bi bi-search"></i>
			</button>
		</form>
		<nav class="ms-auto d-flex justify-content-center align-items-center px-5">
			<a href="<?=base_url('index.php/masuk');?>"
				class="small px-3 py-1 border border-white rounded text-white fw-bold text-uppercase text-decoration-none me-2">
				Masuk
			</a>
			<a href="<?=base_url('index.php/daftar');?>"
				class="small px-3 py-1 border border-white rounded bg-white text-dark fw-bold text-uppercase text-decoration-none">
				Daftar
			</a>
		</nav>
	</div>
</nav>
