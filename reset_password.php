<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    include('token.php');
    $token=new Token();
    $arr_token=$token->getToken('reset_password');

    if(isset($_POST)&&$_POST['reset_password']==$_SESSION['reset_password']){
        unset($_SESSION['reset_password']);
        if($_SESSION['reset_password']) unset($_SESSION['success_reset_password']);
        $email = $_SESSION['email'];
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
                $new_password = md5($_POST['new_password']);
                $sql2 = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
                $conn->query($sql2);
                $_SESSION['success_reset_password'] = true;
                unset($_SESSION['email']);
                unset($_SESSION['token']);
                header("Location: login.php");
                exit;
            }
            
            else {
                $_SESSION['error_password'] = true;
                header("Location: reset_password.php");
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
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            z-index: -1;
            transition: opacity 0.5s ease-in-out;
        }

        .loading {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 5px solid #ccc;
            border-top-color: #333;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="loading">
            <div class="loading-spinner"></div>
            <div class="loading-text">Đang tải...</div>
        </div>
    </div>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
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
                                    <h5 class="text-primary">Đổi mật khẩu</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="">
                                        <input type="hidden" name="<?php echo $arr_token['name'] ?>"  value="<?php echo $arr_token['value']?>" >
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Mật khẩu cũ</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="password" type="password" class="form-control pe-5 password-input" placeholder="Enter old Password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Mật khẩu mới</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="new_password" type="password" class="form-control pe-5 password-input" placeholder="Enter new Password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Nhập lại mật khẩu mới</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="confirm_password" type="password" class="form-control pe-5 password-input" placeholder="Enter confirm Password" id="confirm-password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>     
                                        <div id="confirm-password-error" style="display: none; color: red;">Mật khẩu xác nhận không chính xác</div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="myButton" type="submit">Đổi mật khẩu</button>
                                        </div>
                                        <?php 
                                            if($_SESSION['error_password']) { ?>
                                                <div class="modal fade bs-example-modal-center show" style="display: block; transition: opacity 1s ease-in-out;">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content" style="background: khaki;">
                                                            <div class="modal-body text-center p-5">
                                                                <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 120px; height: 120px;"></lord-icon>
                                                                <div class="mt-4">
                                                                    <h4 class="mb-3">Mật khẩu cũ không chính xác</h4>
                                                                    <p class="text-muted mb-4">Vui lòng thử lại hoặc liên hệ với quản trị viên.</p>
                                                                    <div class="hstack gap-2 justify-content-center">
                                                                        <button type="button" class="btn btn-light" id="close_modal" data-bs-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php unset($_SESSION['error_password']);
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let myButton = document.getElementById("myButton");
            let overlay = document.querySelector(".overlay");

            myButton.addEventListener("click", function() {
                myButton.style.display = "none";
                overlay.style.opacity = 1;
                overlay.style.visibility = "visible";
                overlay.style.zIndex = 9999;
            });
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