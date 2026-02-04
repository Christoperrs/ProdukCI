<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
            <h5 class="m-b-10">Data Produk</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('dashboard'); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active">Master Produk</li>
        </ul>
    </div>

    <div class="page-header-right ms-auto">
        <div class="page-header-right-items">
            <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                <button id="btn-sync" class="btn btn-success">
                    <i class="fas fa-sync me-2"></i>
                    <span>Sync API</span>
                </button>

                <a href="<?= base_url('produk/tambah'); ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th class="wd-30">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($produks as $p): ?>
                                <tr>
                                    <td><span class="text-muted"><?= $no++; ?></span></td>
                                    <td>
                                        <div class="hstack gap-3">
                                            <div class="avatar-text avatar-md bg-soft-primary text-primary">
                                                <?= strtoupper(substr($p->nama_produk, 0, 1)); ?>
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line fw-bold text-dark">
                                                    <?= $p->nama_produk; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp <?= number_format($p->harga, 0, ',', '.'); ?></td>
                                    <td><span class="badge bg-soft-info text-info"><?= $p->nama_kategori; ?></span></td>
                                    <td>
                                        <?php if ($p->nama_status == 'bisa dijual'): ?>
                                            <span class="badge bg-soft-success text-success">Bisa Dijual</span>
                                        <?php else: ?>
                                            <span class="badge bg-soft-danger text-danger">Tidak Bisa Dijual</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="<?= base_url('produk/edit/' . $p->id_produk); ?>" class="avatar-text avatar-md bg-soft-warning text-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('produk/delete/' . $p->id_produk); ?>" class="avatar-text avatar-md bg-soft-danger text-danger btn-delete" data-nama="<?= $p->nama_produk; ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
    </div>
</div>
<script>
// Pastikan script ini diletakkan di bagian paling bawah file
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Inisialisasi DataTable (Gunakan selector yang spesifik)
    if ($.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable().destroy();
    }
    $('#myTable').DataTable({
        language: {
            search: "Cari Produk:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        }
    });

    // 2. Alert Sinkronisasi API (Gunakan delegasi event)
    $(document).on('click', '#btn-sync', function(e) {
        e.preventDefault();
        console.log("Tombol Sync Diklik"); // Untuk debug di F12

        Swal.fire({
            title: 'Sinkronisasi Data?',
            text: "Aplikasi akan mengambil data terbaru dari API Fastprint",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Ya, Sinkronkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mohon Tunggu...',
                    text: 'Sedang menarik data API',
                    allowOutsideClick: false,
                    didOpen: () => { 
                        Swal.showLoading(); 
                    }
                });
                // Arahkan ke URL controller
                window.location.href = "<?= base_url('produk/fetch_from_api'); ?>";
            }
        });
    });

    // 3. Konfirmasi Hapus (Event Delegation untuk Page 2 dst)
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const nama = $(this).data('nama');

        Swal.fire({
            title: 'Hapus Produk?',
            html: `Apakah Anda yakin ingin menghapus produk <strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>