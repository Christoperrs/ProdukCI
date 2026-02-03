<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title"><h5 class="m-b-10">Master Kategori</h5></div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ul>
    </div>
    <div class="page-header-right ms-auto">
        <a href="<?= base_url('kategori/tambah') ?>" class="btn btn-primary">
            <i class="feather-plus me-2"></i>Tambah Kategori
        </a>
    </div>
</div>

<div class="main-content">
    <div class="card stretch stretch-full">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover" id="katTable">
                    <thead>
                        <tr>
                            <th class="wd-30">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kategori as $k): ?>
                        <tr>
                            <td><span class="text-muted"><?= $no++; ?></span></td>
                            <td><strong><?= $k->nama_kategori ?></strong></td>
                            <td class="text-end">
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="<?= base_url('kategori/edit/' . $k->id_kategori) ?>" class="avatar-text avatar-md bg-soft-warning text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('kategori/hapus/' . $k->id_kategori) ?>" class="avatar-text avatar-md bg-soft-danger text-danger btn-delete-kat" data-nama="<?= $k->nama_kategori ?>"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#katTable').DataTable();

    $('.btn-delete-kat').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const nama = $(this).data('nama');
        Swal.fire({
            title: 'Hapus Kategori?',
            html: `Apakah yakin ingin menghapus kategori <strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = href; }
        });
    });
});
</script>