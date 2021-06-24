<table class="table" id="tabel">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama Produk</th>
			<th scope="col">Kuantitas</th>
			<th scope="col">Harga</th>
			<th scope="col">Total</th>
		</tr>
	</thead>
	<tbody>
		<!-- Perulangan data dari sini -->
		<?php $i = 1; $total = 0 ?>
		<?php foreach($detail_pesanan as $item): ?>
		<tr>
			<th><?= $i; $i++ ?></th>
			<td><?= $item -> nama ?></td>
			<td><?= $item -> kuantitas ?></td>
			<td><?= 'Rp '.$this->cart->format_number($item -> harga) ?></td>
			<td><?= 'Rp '.$this->cart->format_number($item -> total) ?></td>
			<?php $total += $item -> total ?>
		</tr>
		<?php endforeach; ?>
		<!-- Tutup perulangan -->
		<tr>
			<th colspan="4">Total</th>
			<td><?= 'Rp '.$this->cart->format_number($total) ?></td>
		</tr>
	</tbody>
</table>
