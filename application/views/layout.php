<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fastprint CRM || CI3 Version</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/vendors.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/dataTables.bs5.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/select2.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/select2-theme.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/theme.min.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?= site_url('dashboard') ?>" class="b-brand">
                    <div class="logo logo-lg d-flex align-items-center gap-2">
                        <div class="avatar-text avatar-sm bg-primary text-white rounded">
                            <i class="feather-trending-up"></i>
                        </div>
                        <span class="fw-bold fs-18 text-white text-uppercase tracking-wider">Fast<span class="text-primary">CRM</span></span>
                    </div>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption"><label>Menu Utama</label></li>
                    <li class="nxl-item">
                        <a href="<?= site_url('dashboard') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= site_url('kategori') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-grid"></i></span>
                            <span class="nxl-mtext">Kategori</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= site_url('produk') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-box"></i></span>
                            <span class="nxl-mtext">Data Produk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box"><div class="hamburger-inner"></div></div>
                    </div>
                </a>
            </div>
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button">
                            <img src="<?= base_url('assets/images/avatar/FotoDiri.png') ?>" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="<?= site_url('login/logout') ?>" class="dropdown-item"><i class="feather-log-out"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="nxl-container">
        <div class="nxl-content">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mx-4 mt-4" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mx-4 mt-4" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php $this->load->view($content); ?>
        </div>
    </main>

    <script src="<?= base_url('assets/vendors/js/vendors.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/js/dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/js/dataTables.bs5.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/js/select2.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(isset($extra_js)) { echo $extra_js; } ?>
</body>
</html>