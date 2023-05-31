<?php
    session_start();
    if ($_SESSION['email']) {
        $email = $_SESSION['email'];
        include_once '../connect.php';
        // Truy vấn để lấy thông tin tài khoản
        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $data = $data[0];
        }
        if ($data['token'] == $_SESSION['token']) {
            include_once '../connect.php';
            $sql = "SELECT * FROM withdrawal";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = [];
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            } else {
                echo "Không có bản ghi nào trong cơ sở dữ liệu";
            }
            $conn->close();
        } 
        else {
            session_unset();
            session_destroy();
            header("Location: ../login.php");
            exit;
        }
    }
    else {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        exit;
    }
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>ONFA | Tạo Bill rút tiền</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- glightbox css -->
    <link rel="stylesheet" href="../assets/libs/glightbox/css/glightbox.min.css">

    <!-- Layout config Js -->
    <script src="../assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="styles.css">
    <style>
		
	</style>
</head>

<body>
<!-- Loading -->
    <div class="overlay" id="loading">
        <div class="loading">
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
        </div>
    </div>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex align-items-center">
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="../assets/images/avatar_default.png" alt="Header Avatar" />
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $email ?></span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Customer</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome <?php echo $email ?></h6>
                                <a class="dropdown-item" href="reset_password.php"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Đổi mật khẩu</span></a>
                                <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Đăng xuất</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
    
    <!-- /.modal -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../assets/images/logo_onfa.png" alt="" height="60">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo_onfa.png" alt="" height="60">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../assets/images/logo_onfa.png" alt="" height="60">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo_onfa.png" alt="" height="60">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="../">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill chuyển khoản</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="index.php">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill rút tiền</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="../create-bet/">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill đơn cược</span>
                            </a>
                        </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Tạo Bill Rút tiền</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <?php foreach($data as $key_data => $value) { if($value['id'] == 4 || $value['id'] == 9 || $value['id'] == 12) continue; ?>
                        
                        <div class="col-md-3 col-sm-6" bis_skin_checked="1">
                            <a href="create-withdrawal.php?id=<?php echo $value['id'] ?>">
                                <div style="background:#000033" class="card text-center" bis_skin_checked="1">
                                    <div class="card-body" bis_skin_checked="1">
                                        <div class="p-50" style="margin-bottom: 1rem">
                                            <img src="../assets/images/logo_onfa.png" alt="" height="50">
                                        </div>
                                        <h4 style="color:white" class="fw-bolder"><?php echo $value['name'] ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/libs/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/libs/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/js/pages/gallery.init.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        window.addEventListener('load', function () {
            setTimeout(function() {
                document.querySelector('#loading').style.display = 'none'
            }, 1000);
            const links = document.querySelectorAll('a');
            for (let i = 0; i < links.length; i++) {
            links[i].addEventListener('click', function(event) {
                document.querySelector('#loading').style.display = 'flex'
                setTimeout(function() {
                    document.querySelector('#loading').style.display = 'none'
                }, 500);
            });
            }
        })
    </script>
</body>

</html>