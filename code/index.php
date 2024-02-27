<?php
include '../authentication/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('location:../authentication/login.php');
}
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Perpustakaan Digital</title>
<link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
<link rel="stylesheet" href="../assets/css/styles.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index.php" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index.php" aria-expanded="false">
                        <span>
                        <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">NAVIGASI</span>
                </li>
                <?php
                if (isset($_SESSION['user']['Level'])) {
                    if ($_SESSION['user']['Level'] == 'Administrator') {
                ?>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=petugas" aria-expanded="false">
                    <span>
                    <i class="ti ti-user"></i>
                    </span>
                    <span class="hide-menu">Petugas</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=user" aria-expanded="false">
                    <span>
                    <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">User</span>
                </a>
                </li>
                <?php
                }
                ?>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=kategori" aria-expanded="false">
                    <span>
                    <i class="ti ti-category"></i>
                    </span>
                    <span class="hide-menu">Kategori</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=buku" aria-expanded="false">
                    <span>
                    <i class="ti ti-book"></i>
                    </span>
                    <span class="hide-menu">Buku</span>
                </a>
                </li>
                <?php
                } else {
                ?>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=peminjaman" aria-expanded="false">
                    <span>
                    <i class="ti ti-books"></i>
                    </span>
                    <span class="hide-menu">Peminjaman</span>
                </a>
                </li>
                <?php
                }
                ?>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=ulasan" aria-expanded="false">
                    <span>
                    <i class="ti ti-star"></i>
                    </span>
                    <span class="hide-menu">Ulasan</span>
                </a>
                </li>
                <?php
                if (isset($_SESSION['user']['Level'])) {
                ?>
                <li class="sidebar-item">
                <a class="sidebar-link" href="?page=laporan" aria-expanded="false">
                    <span>
                    <i class="ti ti-report"></i>
                    </span>
                    <span class="hide-menu">Laporan Peminjaman</span>
                </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <h6 class="fw-semibold mb-1" id="jam"></h6> 
            </li>
        </ul>
        <script type="text/javascript">
            window.onload = function() { jam(); }
        
            function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
        
            e.innerHTML = h +':'+ m +':'+ s;
        
            setTimeout('jam()', 1000);
            }
        
            function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
            }
        </script>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item text-end">
                    <h6 class="fw-semibold mb-0">
                        <?php
                        echo isset($_SESSION['user']['NamaLengkap']) ? $_SESSION['user']['NamaLengkap'] : $_SESSION['user']['Nama'];
                        ?>
                    </h6>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                        <a href="?page=profile" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">My Profile</p>
                        </a>
                        <?php
                        if (isset($_SESSION['user']['UserID'])) {
                        ?>
                            <a href="?page=koleksi" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Collection</p>
                            </a>
                        <?php
                        }
                        ?>
                        <a href="../authentication/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </div>
                    </div>
                </li>
            </ul>
        </div>
        </nav>
    </header>
    <!--  Header End -->
    <div class="container-fluid">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        if (file_exists($page . '.php')) {
            include $page . '.php';
        } else {
            include '404.php';
        }
        ?>
    </div>
    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">&copy <span class="text-primary">Perpustakaan Digital</span></p>
    </div>
</div>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/dashboard.js"></script>
</body>

</html>