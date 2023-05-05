<?php
    session_start();

    $username = 'teammbonfa'; // Tên đăng nhập
    $password = 'onfa11'; // Mật khẩu

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password) {
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Bạn cần nhập chính xác thông tin đăng nhập để truy cập trang này!';
        exit;
    }

    // Xác thực đăng nhập thành công, lưu thông tin vào session
    $_SESSION['authenticated'] = true;
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    include('token.php');
    $token=new Token();
    $arr_token=$token->getToken('register');
    if(isset($_POST)&&$_POST['register']==$_SESSION['register']){
        unset($_SESSION['register']);
        $email = $_POST['email'];
        $password_login = md5($_POST['password']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = date('Y-m-d H:i:s');
        
        include_once 'connect.php';

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['email_error'] = "Email đã tồn tại";
            header('Location: register.php');
            exit;
        } else {
            $sql = "INSERT INTO users (email, password, created_at) VALUES ('$email', '$password_login', '$created_at')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = "Đăng ký thành công";
                header('Location: register.php');
                exit;
            } else {
                $_SESSION['error'] = $conn->error;
                header('Location: register.php');
                exit;
            }
            
        }
        // Đóng kết nối
        $conn->close();
    }
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign Up | Mg188</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100" style="background-size: contain;">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Tạo tài khoản đăng nhập "</p>
                                                        </div>
                                                
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Tạo bill chuyển khoản"</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Mg188.zone "</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Tạo tài khoản mới</h5>
                                        </div>
                                        

                                        <div class="mt-4">

                                            <form method="POST">
                                            <input type="hidden" name="<?php echo $arr_token['name'] ?>"  value="<?php echo $arr_token['value']?>" >
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input name="email" type="email" class="form-control" id="useremail" placeholder="Nhập email" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative auth-pass-inputgroup">
                                                        <input name="password" type="password" class="form-control pe-5" placeholder="Nhập mật khẩu" id="password-input">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative auth-pass-inputgroup">
                                                        <input type="password" class="form-control pe-5" placeholder="Xác nhận mật khẩu" id="confirm-password">
                                                    </div>
                                                </div>
                                                <div id="confirm-password-error" style="display: none; color: red;">Mật khẩu xác nhận không chính xác</div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Tạo tài khoản mới</button>
                                                </div>
                                                <?php 
                                                    if($_SESSION['email_error']) { ?>
                                                        <div class="modal fade bs-example-modal-center show" style="display: block; transition: opacity 1s ease-in-out;">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content" style="background: khaki;">
                                                                    <div class="modal-body text-center p-5">
                                                                        <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 120px; height: 120px;"></lord-icon>
                                                                        <div class="mt-4">
                                                                            <h4 class="mb-3">Email đã tồn tại trên hệ thống</h4>
                                                                            <p class="text-muted mb-4">Vui lòng nhập Email khác hoặc liên hệ với quản trị viên.</p>
                                                                            <div class="hstack gap-2 justify-content-center">
                                                                                <button type="button" class="btn btn-light" id="close_modal" data-bs-dismiss="modal">Đóng</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php unset($_SESSION['email_error']);
                                                    }

                                                    if($_SESSION['error']) {
                                                        echo '<div class="alert alert-danger mb-xl-0" style="margin-top: 10px" role="alert"><strong>'.$_SESSION['error'].'</strong></div>';
                                                        unset($_SESSION['error']);
                                                    }

                                                    if($_SESSION['success']) { ?>
                                                        <div class="modal fade bs-example-modal-center show" style="display: block; transition: opacity 1.5s ease-in-out;">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content" style="background: mistyrose;">
                                                                    <div class="modal-body text-center p-5">
                                                                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 120px; height: 120px;"></lord-icon>
                                                                        <div class="mt-4">
                                                                            <h4 class="mb-3" style="color: seagreen; font-weight: bold; font-size: 28px;">Đăng ký thành công</h4>
                                                                            <p class="text-muted mb-4" style="font-size: 18px">Đã tạo thành công tài khoản trên hệ thống. Vui lòng đăng nhập</p>
                                                                            <div class="hstack gap-2 justify-content-center">
                                                                                <button type="button" class="btn btn-light" id="close_modal" style="color:darksalmon;">Đóng</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php unset($_SESSION['success']);
                                                    }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> Mg188. Crafted with <i class="mdi mdi-heart text-danger"></i> by Bill
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#confirm-password').on('input', function() {
        var password = $('#password-input').val();
        var confirmPassword = $('#confirm-password').val();

        if (password != confirmPassword) {
            $('#confirm-password-error').show();
        } else {
            $('#confirm-password-error').hide();
        }
        });
        var close_modal = document.getElementById('close_modal')
        close_modal.addEventListener('click', function() {
            document.querySelector('.bs-example-modal-center').style.opacity = "0"
            setTimeout(function() {
                document.querySelector('.bs-example-modal-center').style.display = "none";
            }, 2000);
            
        })
    });
    </script>
</body>

</html>