<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title"><h5 class="m-b-10">CRM Dashboard</h5></div>
    </div>
</div>

<div class="main-content">
    <div class="row">
        <div class="col-md-3">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="fs-11 fw-semibold text-uppercase text-muted">Total Produk</div>
                            <h4 class="fs-18 fw-bold mb-0"><?= $total_produk ?></h4>
                        </div>
                        <div class="avatar-text avatar-md bg-soft-primary text-primary"><i class="feather-box"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="fs-11 fw-semibold text-uppercase text-muted">Bisa Dijual</div>
                            <h4 class="fs-18 fw-bold mb-0 text-success"><?= $bisa_dijual ?></h4>
                        </div>
                        <div class="avatar-text avatar-md bg-soft-success text-success"><i class="feather-check-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="fs-11 fw-semibold text-uppercase text-muted">Total Kategori</div>
                            <h4 class="fs-18 fw-bold mb-0"><?= $total_kategori ?></h4>
                        </div>
                        <div class="avatar-text avatar-md bg-soft-info text-info"><i class="feather-grid"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card stretch stretch-full">
                <div class="card-header"><h5>Produk per Kategori</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($statistik_kategori as $kat): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $kat->nama_kategori ?>
                            <span class="badge bg-soft-primary text-primary rounded-pill"><?= $kat->jumlah ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card stretch stretch-full">
                <div class="card-header"><h5>Visualisasi Distribusi</h5></div>
                <div class="card-body">
                    <canvas id="categoryChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        
        const labels = [<?php foreach($statistik_kategori as $k) { echo '"'.$k->nama_kategori.'",'; } ?>];
        const dataValues = [<?php foreach($statistik_kategori as $k) { echo $k->jumlah.','; } ?>];

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#5a5c69'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>