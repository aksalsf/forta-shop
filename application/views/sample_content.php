<!-- Contoh Form -->
<form action="#">
    <div class="mb-3">
        <label for="#" class="fw-bold mb-2">Nama</label>
        <input type="text" class="form-control shadow-none">
    </div>
</form>
<!-- Contoh Tabel -->
<table class="table table-bordered" id="tabel">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pembeli</th>
            <th scope="col">Nama Ponsel</th>
            <th scope="col">Status</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Perulangan data dari sini -->
        <tr>
            <th>1</th>
            <td>Aksal Syah Falah</td>
            <td>Realme C11</td>
            <td>Lunas</td>
            <td>
                <a href="#" class="btn btn-success btn-sm">
                    <i class="bi bi-eye-fill me-1"></i>Detail
                </a>
                <a href="#" class="btn btn-warning btn-sm">
                    <i class="bi bi-eye-fill me-1"></i>Ganti Status
                </a>
            </td>
        </tr>
        <!-- Tutup perulangan -->
    </tbody>
</table>
<!-- Menambahkan filter dan sorting di tabel -->
<script>
$(document).ready(function() {
    $('#tabel').DataTable();
});
</script>
<!--
    Menambahkan ikon
    <i class="bi bi-{nama-ikon}"></i>
    Referensi: https://icons.getbootstrap.com/
 -->