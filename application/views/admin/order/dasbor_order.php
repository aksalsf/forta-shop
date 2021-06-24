<table class="table table-bordered" id="tabel">
	<thead class="table-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama Pembeli</th>
			<th scope="col">Kode</th>
			<th scope="col">Tanggal Pesanan</th>
			<th scope="col">Status</th>
			<th scope="col">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<!-- Perulangan data dari sini -->
		<?php $i = 1 ?>
		<?php foreach($riwayat_pesanan as $pesanan): ?>
		<tr>
			<th><?= $i ?></th>
			<td><?= $pesanan -> nama ?></td>
			<td><?= $pesanan -> kode_pesanan ?></td>
			<td><?= $pesanan -> tgl_pesan ?></td>
			<td><?= $pesanan -> status ?></td>
			<td class="d-flex flex-column">
				<a href="<?= base_url('admin/order/detail/'.$pesanan->id_pesanan) ?>"
					class="badge btn btn-dark btn-sm mb-1">
					<i class="bi bi-eye-fill me-1"></i>Detail
				</a>
				<form action="<?= base_url('admin/order/verifikasi') ?>" method="post" class="w-100">
					<input type="hidden" name="id_pesanan" value="<?= $pesanan -> id_pesanan ?>">
					<button type="submit" class="badge btn btn-primary btn-sm text-white w-100">
						<i class="bi bi-truck me-1"></i>Verifikasi
					</button>
				</form>
			</td>
		</tr>
		<?php $i++ ?>
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
