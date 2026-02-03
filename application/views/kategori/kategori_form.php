<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title"><h5 class="m-b-10"><?= $title ?></h5></div>
    </div>
</div>

<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-xxl-6">
            <div class="card stretch stretch-full">
                <div class="card-body p-4">
                    <?php $action = isset($kat) ? 'kategori/update' : 'kategori/simpan'; ?>
                    <form action="<?= base_url($action) ?>" method="POST">
                        <?php if(isset($kat)): ?>
                            <input type="hidden" name="id" value="<?= $kat->id_kategori ?>">
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" value="<?= isset($kat) ? $kat->nama_kategori : '' ?>" required placeholder="Contoh: ATK, Tinta, dll">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="<?= base_url('kategori') ?>" class="btn btn-light-brand">Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="feather-save me-2"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>