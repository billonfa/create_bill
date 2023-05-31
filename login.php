<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    include('token.php');
    $token=new Token();
    $arr_token=$token->getToken('login');
    if (($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
    if(isset($_POST)&&$_POST['login']==$_SESSION['login']){
        unset($_SESSION['login']);
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        // Kết nối đến cơ sở dữ liệu
        include_once 'connect.php';
        // Truy vấn để lấy thông tin tài khoản
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $data = $data[0];
            if($password == $data['password']) {
                $_SESSION['email'] = $email;
                $_SESSION['refresh'] = true;
                $new_token = mt_rand(10000,99999);
                $_SESSION['token'] = $new_token;
                $sql2 = "UPDATE users SET token='$new_token' WHERE email = '$email'";
                $conn->query($sql2);
                header("Location: index.php");
                exit;
            }
            else  {
                $_SESSION['error_password'] = "Sai Password";
                header("Location: login.php");
                exit;
            }
        }
        else {
            $_SESSION['error_email'] = "Sai Email";
            header("Location: login.php");
            exit;
        }
        
        // Đóng kết nối
        $conn->close();
    }
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | MG188</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles" style="background: #000033">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Đăng nhập tạo bill</h5>
                                    <?php
                                        if($_SESSION['success_reset_password']) {
                                            echo '<div class="alert alert-success" role="alert"><strong>Đổi mật khẩu thành công. Vui lòng đăng nhập lại</strong></div>';
                                            unset($_SESSION['success_reset_password']);
                                        }
                                    ?>
                                    
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="">
                                        <input type="hidden" name="<?php echo $arr_token['name'] ?>"  value="<?php echo $arr_token['value']?>" >
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">

                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="password" type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
                                        </div>
                                        <?php 
                                            if($_SESSION['error_email']) {
                                                echo '<div class="alert alert-danger mb-xl-0" style="margin-top: 10px" role="alert"><strong>'.$_SESSION['error_email'].'</strong></div>';
                                                unset($_SESSION['error_email']);
                                            }
                                            if($_SESSION['error_password']) {
                                                echo '<div class="alert alert-danger mb-xl-0" style="margin-top: 10px" role="alert"><strong>'.$_SESSION['error_password'].'</strong></div>';
                                                unset($_SESSION['error_password']);
                                            }
                                        ?>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Mg188. Crafted with <i class="mdi mdi-heart text-danger"></i> by Bill
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>