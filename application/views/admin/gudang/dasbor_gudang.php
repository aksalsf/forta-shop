<div class="d-flex mb-5 justify-content-end">
	<span class="me-auto fs-3">🐱‍💻</span>
	<button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalProduk">[+] Produk Baru</button>
	<button class="btn text-primary border-primary" data-bs-toggle="modal" data-bs-target="#modalStok">[+] Update
		Stok</button>
</div>
<table class="table table-bordered" id="tabel">
	<thead class="table-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Produk</th>
			<th scope="col">Brand</th>
			<th scope="col">Harga</th>
			<th scope="col">Stok</th>
			<th scope="col" class="text-center">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<!-- Perulangan data dari sini -->
		<?php $i = 1; ?>
		<?php foreach($gudang as $produk): ?>
		<tr>
			<th style="vertical-align:middle;" class="text-center"><?= $i;$i++ ?></th>
			<td style="vertical-align:middle;" class="col-4"><?= $produk['nama'] ?></td>
			<td style="vertical-align:middle;"><?= $produk['brand'] ?></td>
			<td style="vertical-align:middle;">Rp <?= $this->cart->format_number($produk['harga']); ?></td>
			<td style="vertical-align:middle;"><?= $produk['stok'] ?></td>
			<td style="vertical-align:middle;">
				<div class="d-flex flex-column">
					<a href="<?= base_url('admin/gudang/detail/'.$produk['id_produk']) ?>"
						class="badge btn btn-dark mb-1">
						<i class="bi bi-eye"></i>
						Detail
					</a>
					<a href="<?= base_url('admin/gudang/sunting/'.$produk['id_produk']) ?>"
						class="badge btn btn-warning text-white mb-1">
						<i class="bi bi-pencil-square"></i>
						Sunting
					</a>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		<!-- Tutup perulangan -->
	</tbody>
</table>
<!-- Menambahkan filter dan sorting di tabel -->
<script>
	$(document).ready(function () {
		$('#tabel').DataTable();
	});

</script>
<?php $this->load->view('admin/gudang/form_produk_gudang'); ?>
<?php $this->load->view('admin/gudang/form_stok_gudang'); ?>
