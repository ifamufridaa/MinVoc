<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/admin/assets/css/style.css" />
    <link rel="shortcut icon" href="/image/favicon.svg" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Style dropdown sidebar--Mengatur tampilan menu dropdown */
        .menu-items .nav-link {
            position: relative;
        }

        .menu-arrow {
            color: inherit;
            position: absolute;
            left: 185px;
            top: 185px;
            transform: translateY(-50%);
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
            max-width: 400px;
            /* Set the maximum width as needed */
        }

        /* Style Untuk search input */
        .search-input {
            border-radius: 15px;
            border: 1px solid #eaeaea;
            padding: 5px 10px;
            width: 100%;
        }

        /* Style Untuk search results */
        #search-results {
            list-style: none;
            position: absolute;
            top: 60px;
            left: 30px;
            width: 52%;
            background-color: white;
            border: 1.5px solid #eaeaea;
            padding: 10px;
            display: none;
            border-radius: 10px;
            font-size: 15px
        }

        .sidebar .nav.sub-menu .nav-item .nav-link:hover {
            color: #7c6890;
        }
    </style>

    <script>
        function confirmDelete(message, callback) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }

        function deleteGenre(code) {
            confirmDelete('Yakin menghapus Genre Lagu ini?', function() {
                window.location.href = '/admin/hapus-genre/' + code;
            });
        }

        function deleteSong(code) {
            confirmDelete('Yakin menghapus Lagu ini?', function() {
                window.location.href = '/admin/hapus-music/' + code;
            });
        }

        function deleteBillboard(code) {
            confirmDelete('Yakin menghapus Billboard ini?', function() {
                window.location.href = '/admin/hapus-billboard/' + code;
            });
        }
    </script>


</head>

<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg"
                        alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/admin/dashboard">
                        <span class="menu-icon ">
                            <i class="mdi mdi-home"></i>
                        </span>
                        <span class="menu-title">Beranda</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/admin/persetujuan">
                        <span class="menu-icon">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                        <span class="menu-title">Persetujuan</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/admin/kategori">
                        <span class="menu-icon">
                            <i class="mdi mdi-music"></i>
                        </span>
                        <span class="menu-title">Kategori</span>
                        <a href="#ui-basic" data-toggle="collapse" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span>
                        </a>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/iklan">
                                    <span class="menu-icon">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </span>
                                    <span class="menu-title">Papan iklan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/admin/verifikasi">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-check-outline"></i>
                        </span>
                        <span class="menu-title">Verifikasi</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/admin/riwayat">
                        <span class="menu-icon">
                            <i class="mdi mdi-clock-outline"></i>
                        </span>
                        <span class="menu-title">Riwayat</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <a href="#" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon">
                                            <img src="assets/images/faces/face16.jpg" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Ahmad</p>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon">
                                            <img src="assets/images/faces/face12.jpg">
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Gajah</p>
                                        <p class="text-muted ellipsis mb-0"> Tulus </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg"
                                        alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <div class="p-3 mb-0 gap-3"
                                    style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                    <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg"
                                        alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Henry Klein</p>
                                </div>
                                <a class="dropdown-item preview-item" href="{{ route('logout.users') }}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon rounded-circle">
                                            <i class="mdi mdi-logout"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            @include('sweetalert::alert')
            @yield('content')

            <script src="assets/js/liked.js"></script>
            <script src="/user/assets/js/closepopup.js"></script>
            <!-- plugins:js -->
            <script src="assets/vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="assets/vendors/chart.js/Chart.min.js"></script>
            <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
            <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
            <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="assets/js/off-canvas.js"></script>
            <script src="assets/js/hoverable-collapse.js"></script>
            <script src="assets/js/misc.js"></script>
            <script src="assets/js/settings.js"></script>
            <script src="assets/js/todolist.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page -->
            <script src="assets/js/dashboard.js"></script>
            <!-- End custom js for this page -->

</body>

</html>
