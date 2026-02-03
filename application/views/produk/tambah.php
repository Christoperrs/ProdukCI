<?php ob_start(); ?>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Produk</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('produk/tambah'); ?>" method="post">
                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status_id" class="form-control">
                        <?php foreach($status as $s): ?>
                            <option value="<?= $s->id_status ?>"><?= $s->nama_status ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan Produk</button>
                <a href="<?= base_url('produk'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?php
$contentPlaceHolder = ob_get_contents();
ob_end_clean();
include __DIR__ . "/../layout.php"; // Sesuaikan path layout
?>