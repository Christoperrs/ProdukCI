<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
            <h5 class="m-b-10"><?= $title; ?></h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('produk'); ?>">Data Produk</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-8">
            <div class="card stretch stretch-full">
                <div class="card-body p-4">
                    <?php 
                        $action = isset($produk) ? 'produk/update' : 'produk/simpan'; 
                        $val_id = isset($produk) ? $produk->id_produk : '';
                        $val_nama = isset($produk) ? $produk->nama_produk : '';
                        $val_harga = isset($produk) ? $produk->harga : '';
                        $val_kat = isset($produk) ? $produk->id_kategori : '';
                        $val_stat = isset($produk) ? $produk->id_status : '';
                    ?>
                    
                    <form action="<?= base_url($action); ?>" method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">ID Produk</label>
                            <input type="number" name="id_produk" class="form-control" 
                                   value="<?= $val_id ?>" 
                                   <?= isset($produk) ? 'readonly' : 'required' ?> 
                                   placeholder="Masukkan ID unik">
                            <?php if(!isset($produk)): ?>
                                <small class="text-muted d-block mt-1">ID harus unik sesuai referensi API Fastprint.</small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" 
                                   value="<?= $val_nama ?>" required placeholder="Nama Produk">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" 
                                       value="<?= $val_harga ?>" required placeholder="0">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k->id_kategori ?>" <?= ($k->id_kategori == $val_kat) ? 'selected' : '' ?>>
                                        <?= $k->nama_kategori ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <select name="id_status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <?php foreach($status as $s): ?>
                                    <option value="<?= $s->id_status ?>" <?= ($s->id_status == $val_stat) ? 'selected' : '' ?>>
                                        <?= $s->nama_status ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="<?= base_url('produk'); ?>" class="btn btn-light-brand">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="feather-save me-2"></i><?= isset($produk) ? 'Perbarui' : 'Simpan' ?> Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>