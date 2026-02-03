<?php ob_start(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Produk: <?= $produk->nama_produk ?></h4>
                    <a href="<?= base_url('produk'); ?>" class="btn btn-sm btn-light">Batal</a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('produk/edit/' . $produk->id_produk); ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" 
                                   value="<?= set_value('nama_produk', $produk->nama_produk); ?>" required>
                            <?= form_error('nama_produk', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" 
                                   value="<?= set_value('harga', (int)$produk->harga); ?>" required>
                            <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k->id_kategori ?>" <?= ($k->id_kategori == $produk->kategori_id) ? 'selected' : '' ?>>
                                        <?= $k->nama_kategori ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select" required>
                                <?php foreach($status as $s): ?>
                                    <option value="<?= $s->id_status ?>" <?= ($s->id_status == $produk->status_id) ? 'selected' : '' ?>>
                                        <?= $s->nama_status ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Update Data Produk</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$contentPlaceHolder = ob_get_contents();
ob_end_clean();
include __DIR__ . "/../layout.php"; 
?>