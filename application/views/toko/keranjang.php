<div class="container-fluid p-5">
	<h1 class="display-3 mb-5">
		<?= $title ?>
	</h1>
	<div class="row justify-content-between">
		<?php if($this->cart->total_items() >= 1): ?>
		<div class="col-8">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Produk</th>
						<th scope="col">Harga</th>
						<th scope="col">Kuantitas</th>
						<th scope="col" class="text-center">Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->cart->contents() as $item): ?>
					<tr>
						<td class="col-5 py-5 fw-bold" style="vertical-align:middle"><?= $item['name'] ?></td>
						<td class="col-3 py-5" style="vertical-align:middle">Rp
							<?= $this->cart->format_number($item['subtotal']) ?></td>
						<form action="<?= base_url('toko/keranjang/simpan') ?>" method="post">
							<td class="col-1 py-5" style="vertical-align:middle">
								<input type="number" name="qty" value="<?= $item['qty'] ?>"
									class="form-control bg-transparent border-light shadow-none fw-bold" min="1"
									required>
							</td>
							<td class="d-flex align-items-center justify-content-center py-5">
								<input type="hidden" name="id_produk" value="<?= $item['id'] ?>">
								<input type="hidden" name="rowid" value="<?= $item['rowid'] ?>">
								<button type="submit" class="btn bg-transparent shadow-none" title="Simpan">
									<i class="bi bi-arrow-repeat fs-5"></i>
								</button>
						</form>
						<form action="<?= base_url('toko/keranjang/hapus') ?>" method="post">
							<input type="hidden" name="rowid" value="<?= $item['rowid'] ?>">
							<button type="submit" class="btn bg-transparent shadow-none" title="Hapus">
								<i class="bi bi-x fs-3"></i>
							</button>
						</form>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-4 ps-5">
			<h5 class="border-bottom border-dark pb-3">Pesanan Kamu</h5>
			<table class="table">
				<tr>
					<td class="py-3">Jumlah Pembelian:</td>
					<td class="py-3 text-end fw-bold"><?= $this->cart->total_items(); ?></td>
				</tr>
				<tr>
					<td class="py-3">Total:</td>
					<td class="py-3 text-end fw-bold">
						Rp <?= $this->cart->format_number($this->cart->total()); ?>
					</td>
				</tr>
			</table>
			<form action="<?= base_url('toko/checkout') ?>" method="post" class="d-flex">
				<button type="submit" class="btn btn-dark w-100 shadow-none">Checkout</button>
			</form>
		</div>
		<?php else: ?>
		<h5 class="text-center py-5">Masih kosong nih 😓</h5>
		<?php endif; ?>
	</div>
</div>
