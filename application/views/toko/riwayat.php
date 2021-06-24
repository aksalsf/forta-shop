<div class="container-fluid p-5">
	<h1 class="display-3 mb-5">
		<?= $title ?>
	</h1>
	<hr>
	<?php if(count($riwayat) > 0): ?>
	<?php foreach($riwayat as $kode_pesanan => $detail_riwayat): ?>
	<div class="col-10 p-5 rounded bg-white shadow-sm mb-5">
		<div class="d-flex align-items-center mb-5">
			<h2 class="fw-bold mb-0">#<?= $kode_pesanan ?></h2>
			<aside class="d-flex flex-column ms-auto text-end">
				<time><?= $detail_riwayat['tgl_pesan'] ?></time>
				<small class="mt-1 text-danger"><?= $detail_riwayat['status'] ?></small>
			</aside>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Produk</th>
					<th scope="col" class="text-start">Harga</th>
					<th scope="col">Kuantitas</th>
					<th scope="col" class="text-end">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0 ?>
				<?php foreach($detail_riwayat['detail'] as $detail): ?>
				<tr>
					<td class="col-5 py-5" style="vertical-align:middle">
						<?= $detail['nama'] ?>
					</td>
					<td class="col-3 py-5 text-start" style="vertical-align:middle">
						<?= 'Rp ' . $this->cart->format_number($detail['harga']); ?>
					</td>
					<td class="py-5" style="vertical-align:middle">
						<?= $detail['kuantitas'] ?>
					</td>
					<td class="col-4 py-5 text-end" style="vertical-align:middle">
						<?= 'Rp ' . $this->cart->format_number($detail['total']); ?>
						<?php $total += $detail['total'] ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<th colspan="3">
						Total
					</th>
					<td class="text-end"><?= 'Rp ' . $this->cart->format_number($total); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
	<h5 class="text-center py-5">Masih kosong nih 😓</h5>
	<?php endif; ?>
</div>
