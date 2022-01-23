<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafein | <?= $url->getSegment(3) ?> </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/simple-line-icons/css/simple-line-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/public/images/favicon.png" />

    <script src="<?php echo base_url() ?>/public/js/jquery/jquery.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../../index.html">
                        <img src="<?= base_url() ?>/public/images/logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../../index.html">
                        <img src="<?= base_url() ?>/public/images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Hallo, <span class="text-black fw-bold"><?= session()->get("nama") ?></span></h1>
                        <h3 class="welcome-sub-text"> Semoga hari ini lancar ya :) </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a type="button" class="btn btn-social-icon-text btn-dribbble" href="dashboard/logout"><i class="mdi mdi-account-check"></i>Log out</a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item <?php if ($url->getSegment(3) == "antrian") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="antrian">
                            <i class="menu-icon mdi mdi-chair-school"></i>
                            <span class="menu-title">Antrian</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($url->getSegment(3) == "laporan") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="laporan">
                            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Data Master</li>
                    <li class="nav-item <?php if ($url->getSegment(3) == "menu") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="menu">
                            <i class="menu-icon mdi mdi-food-fork-drink"></i>
                            <span class="menu-title">Menu</span>
                        </a>
                    </li>
                    <?php if (session()->get("rule") == 1) : ?>
                        <li class="nav-item <?php if ($url->getSegment(3) == "user") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="user">
                                <i class="menu-icon mdi mdi-account-multiple"></i>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php $this->renderSection('content'); ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
                    </div>
                </footer>
            </div>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- endinject -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>/public/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>/public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>/public/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>/public/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>/public/js/settings.js"></script>
    <script src="<?= base_url() ?>/public/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>