<table class="table table-bordered" id="tabel">
	<thead class="table-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Surel</th>
			<th scope="col">No. Ponsel</th>
			<th scope="col">Status</th>
			<th scope="col" class="text-center">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<!-- Perulangan data dari sini -->
		<?php $i = 1; ?>
		<?php foreach($pelangganCollection as $pelanggan): ?>
		<tr>
			<th style="vertical-align:middle;" class="text-center"><?= $i;$i++ ?></th>
			<td style="vertical-align:middle;"><?= $pelanggan -> nama ?></td>
			<td style="vertical-align:middle;"><?= $pelanggan -> surel ?></td>
			<td style="vertical-align:middle;"><?= $pelanggan -> no_ponsel; ?></td>
			<td style="vertical-align:middle;"><?= $pelanggan -> status ?></td>
			<td style="vertical-align:middle;">
				<div class="d-flex flex-column">
					<a href="<?= base_url('admin/pelanggan/detail/'.$pelanggan -> id_pelanggan) ?>"
						class="badge btn btn-dark mb-1">
						<i class="bi bi-eye"></i>
						Detail
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
