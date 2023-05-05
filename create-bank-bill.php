<?php
    session_start();
    if ($_SESSION['email']) {
        $email = $_SESSION['email'];
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
        }
        if ($data['token'] == $_SESSION['token']) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                include_once 'connect.php';
                // Câu truy vấn SQL để lấy dữ liệu
                $sql2 = "SELECT * FROM bank WHERE id = '$id'";
                // Thực hiện câu truy vấn và lấy kết quả
                $result = $conn->query($sql2);
                // Kiểm tra kết quả trả về
                if ($result->num_rows > 0) {
                    $data2 = [];
                    // Duyệt qua từng bản ghi và lấy dữ liệu
                    while ($row = $result->fetch_assoc()) {
                        $data2[] = $row;
                    }
                } else {
                    echo "Không có bản ghi nào trong cơ sở dữ liệu";
                }
                // Đóng kết nối tới cơ sở dữ liệu
                $conn->close();
                $value = $data2[0];
            }
        } 
        else {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit;
        }
    }
    else {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/libs/glightbox/css/glightbox.min.css">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script async src="assets/js/html2canvas.min.js"></script>
    <script async src="assets/js/FileSaver.min.js"></script>
    <script async src="assets/js/create-bill.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $value['name'] ?></title>
</head>
<body>

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
                                    <img class="rounded-circle header-profile-user" src="assets/images/avatar_default.png" alt="Header Avatar" />
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
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
        <div class="app-menu navbar-menu" style="background:#000033">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo_mg188.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo_mg188.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo_mg188.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo_mg188.png" alt="" height="17">
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
                            <a class="nav-link menu-link" href="index.php">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill chuyển khoản</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Tạo bill <?php echo $value['name'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container_box" bis_skin_checked="1">
                            <div class="box">
                                <div class="create-image-container" id="new_bill<?php echo $id ?>">
                                    <img class="photo_style" src="photo/<?php echo $value['photo'] ?>" alt="Demo bill" />
                                    <?php
                                    switch ($id) {
                                            //------------------------- Dữ liệu của ACB -------------------------
                                        case 1: { ?>
                                    <div id="output_clock-acb" class="time_acb">20:40</div>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div class="total_price_number_acb"><span id="output_total_number-acb">1.000.000.000</span> VND</div>
                                    <div id="output_total_text-acb" class="total_price_text_acb">Một tỷ đồng</div>
                                    <div id="output_time-acb" class="order_time_acb">11/10/2022 - 20:40:00</div>
                                    <div id="output_day-acb" class="order_date_acb">11/10/2022</div>
                                    <div id="output_transferer_name-acb" class="transferer_name_acb">NGUYEN HO TUAN TINH</div>
                                    <div id="output_transferer_number-acb" class="transferer_number_acb">99999</div>
                                    <div id="output_recipient_name-acb" class="recipient_name_acb">NGUYEN HO TUAN TINH</div>
                                    <div id="output_recipient_bank-acb" class="bank_name_acb">ACB - NH TMCP A CHAU</div>
                                    <div id="output_recipient_number-acb" class="recipient_number_acb">8888888</div>
                                    <span class="bank_now_acb">Chuyển ngay</span>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của Agribank -------------------------
                                        case 2: { ?>
                                    <div id="output_clock-agribank" class="time-agribank">20:40</div>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div class="total_price_number-agribank"><span id="output_total_price-agribank">1.000.000.000</span> VND
                                    </div>
                                    <div id="output_recipient_number-agribank" class="recipient_number-agribank">123456789</div>
                                    <div id="output_recipient_name-agribank" class="recipient_name-agribank">NGUYEN TINH</div>
                                    <div id="output_trade_code-agribank" class="trade_code-agribank">106706</div>
                                    <div id="output_recipient_bank-agribank" class="recipient_bank-agribank">Vietcombank</div>
                                    <div id="output_trade_time-agribank" class="trade_time">12:29 08/12/2023</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của BIDV -------------------------
                                        case 3: { ?>
                                    <span id="output_clock-bidv" class="time-bidv">20:40</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_black"></div>
                                    <div class="content1">Quý khách đã chuyển thành công số tiền</div>
                                    <div class="total_price-bidv">
                                        <span id="output_total_price-bidv">999,999,999</span> <span style="color:#0068bb; font-weight:600">VND</span><span> đến số tài khoản</span>
                                    </div>
                                    <div class="infomation_recipient-bidv">
                                        <span class="color_bl" id="output_recipient_number-bidv">68686868686868</span><span class="xoet">/
                                        </span>
                                        <span class="color_bl" id="output_recipient_name-bidv">NGUYEN TINH NGUYEN TINH</span><span
                                            class="xoet">/ </span>
                                        <span class="color_bl" id="output_recipient_bank-bidv"> NHTMCP Ngoại thương</span>
                                        <span> vào lúc </span>
                                        <span class="xoet" id="output_time-bidv">13/03/2023 13:32:32</span><span>. Nội dung: </span>
                                        <span id="output_content-bidv"> 3424</span>
                                    </div>
                                    <div id="output_code_number-bidv" class="code_number-bidv">143369</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của MB Bank -------------------------
                                        case 4: { ?>
                                    <span id="output_clock-mbbank" class="time-bidv">20:40</span>
                                    <div class="done_bill">Bạn đã chuyển tiền thành công</div>
                                    <span class="total_price-mbbank" id="output_total_price-mbbank">999,999,999 VND</span>
                                    <div class="recipient_name-mbbank" id="output_recipient_name-mbbank">NGUYEN TINH</div>
                                    <div class="recipient_number-mbbank" id="output_recipient_number-mbbank">99999999999999</div>
                                    <div class="recipient_bank_icon-mbbank" id="output_recipient_icon-mbbank"></div>
                                    <div class="recipient_bank_text-mbbank" id="output_recipient_text-mbbank">Ngoại thương Việt Nam
                                        (Vietcombank, VCB)</div>
                                    <div class="source_account-mbbank" id="output_source_account-mbbank">8888888888</div>
                                    <div class="source_name-mbbank" id="output_source_name-mbbank">NGUYEN TINH NGUYEN</div>
                                    <div class="content-mbbank" id="output_content-mbbank">demo bill mbbank</div>
                                    <div class="time-mbbank" id="output_time-mbbank">18:29:16, 07/01/2023</div>
                                    <div class="hinh_thuc_chuyen-mbbank">Chuyển nhanh Napas</div>
                                    <div class="text_247-mbbank">247</div>
                                    <div class="trade_code-mbbank" id="output_trade_code-mbbank">FT22358547622890</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của Momo -------------------------
                                        case 5: { ?>
                                    <span id="output_clock-momo" class="clock-momo">20:40</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div class="recipient_name-momo">
                                        CHUYỂN TIỀN ĐẾN
                                        <span id="output_recipient_name-momo">NGUYEN TINH TINH</span>
                                        <span>(<span id="output_recipient_bank-momo">ACB</span>)</span>
                                    </div>
                                    <div class="total_price-momo"><span class="subtraction">-<span
                                                id="output_total_price-momo">50.000.000</span><span>đ</span></div>
                                    <div id="output_time-momo" class="time-momo">21:29 - 19/02/2023</div>
                                    <div id="output_trade_code-momo" class="trade_code-momo">35637957291</div>
                                    <div id="output_transfer_bank-momo" class="transfer_bank-momo">Ví MoMo</div>
                                    <div class="overheads-momo"><span id="output_overheads-momo">Miễn phí</span></div>
                                    <div id="output_recipient_number-momo" class="recipient_number-momo">99999999999</div>
                                    <div id="output_banking_name-momo" class="banking_name-momo">NGUYEN TINH</div>
                                    <div id="output_banking_bank-momo" class="banking_bank-momo"> NH TMCP A Chau (ACB)</div>
                                    <div class="total_price2-momo"><span id="output_total_price2-momo">50.000.000</span><span>VND</span>
                                    </div>
                                    <div id="output_message-momo" class="message-momo">3424</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của MSB -------------------------
                                        case 6: { ?>
                                    <span id="output_clock-msb" class="clock-msb">20:40</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_black"></div>
                                    <div id="output_holder_name-msb" class="holder_name-msb">Nguyen Tinh</div>
                                    <div class="total_price-msb"><span id="output_total_price-msb">1,000,000,000</span> VND</div>
                                    <div id="output_recipient_number-msb" class="recipient_number-msb">9999999999</div>
                                    <div id="output_recipient_name-msb" class="recipient_name-msb">NGUYEN HO TUAN TINH</div>
                                    <div id="output_message-msb" class="message-msb">Demo Bill MSB</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của Sacombank -------------------------
                                        case 7: { ?>
                                    <div id="output_clock-sacombank" class="clock-sacombank">20:40</div>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div class="recipient_number-sacombank">
                                        <span id="output_recipient_number-sacombank">0041000348615</span>
                                        (<span id="output_recipient_name-sacombank">NGUYEN HO TUAN TINH</span>)
                                    </div>
                                    <div class="total_price-sacombank">-<span id="output_total_price-sacombank">1,000,000,000</span>đ</div>
                                    <div id="output_time-sacombank" class="time-sacombank">14:09:47 08/02/2023</div>
                                    <div id="output_trade_code-sacombank" class="trade_code-sacombank">3872493694</div>
                                    <div class="cate_trade-sacombank">Chuyển tiền từ TK Sacombank đến TK NH nội địa</div>
                                    <div id="output_from_number-sacombank" class="from_number-sacombank">9999999</div>
                                    <div id="output_recipient_number2-sacombank" class="recipient_number2-sacombank">0041000348615</div>
                                    <div id="output_recipient_bank-sacombank" class="recipient_bank-sacombank">Vietcombank</div>
                                    <div id="output_message-sacombank" class="message-sacombank">demo bill Sacombank</div>
                                    <div id="output_total_price2-sacombank" class="total_price2-sacombank">1,000,000,000</div>
                                    <div id="output_total_price3-sacombank" class="total_price3-sacombank">1,000,000,000</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của Techcombank -------------------------
                                        case 8: { ?>
                                    <span id="output_clock-techcombank" class="clock-techcombank">20:40</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg" /></span>
                                    </div>
                                    <div class="block_recipient_name-techcombank">
                                        <div>Chuyển thành công</div>
                                        <div style="width:369px">tới <span id="output_recipient_name-techcombank"
                                                class="recipient_name-techcombank">NGUYEN TINH</span></div>
                                        <div>VND</div>
                                        <div id="output_total_price-techcombank" class="total_price-techcombank">99,999,999,999</div>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_black"></div>
                                    <div id="output_recipient_bank-techcombank" class="recipient_bank-techcombank">Ngân hàng TMCP Ngoại
                                        thương Việt Nam</div>
                                    <div id="output_recipient_number-techcombank" class="recipient_number-techcombank">8989 8989 898</div>
                                    <div id="output_message-techcombank" class="message-techcombank">Demo bill Techcombank</div>
                                    <div id="output_time-techcombank" class="time-techcombank">18 tháng 3, 2023</div>
                                    <div class="trade_code-techcombank">FT<span id="output_trade_code-techcombank">22288197735763</span>
                                    </div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của TpBank -------------------------
                                        case 9: {
                                                break;
                                            }
                                            //------------------------- Dữ liệu của Vietcombank -------------------------
                                        case 10: { ?>
                                    <span id="output_clock-vietcombank" class="clock-vietcombank">20:40</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div class="total_price-vietcombank"><span id="output_total_price-vietcombank">999,999,999</span> VND
                                    </div>
                                    <div id="output_time-vietcombank" class="time-vietcombank">15:00 Thứ Ba 25/10/2022</div>
                                    <div id="output_recipient_name-vietcombank" class="recipient_name-vietcombank">NGUYEN HO TUAN TINH</div>
                                    <div id="output_recipient_number-vietcombank" class="recipient_number-vietcombank">9999999999999</div>
                                    <div id="output_recipient_bank_name-vietcombank" class="recipient_bank_name-vietcombank">Ngân hàng Quân Đội</div>
                                    <div id="output_trade_code-vietcombank" class="trade_code-vietcombank">2616042867</div>
                                    <div id="output_message-vietcombank" class="message-vietcombank">demo bill</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của Vietinbank -------------------------
                                        case 11: { ?>
                                    <span id="output_clock-vietinbank" class="clock-vietcombank">17:20</span>
                                    <div id="output_signal" class="signal">
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                        <div class="bar background_white"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi">
                                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="battery-level background_white"></div>
                                    <div id="output_time-vietinbank" class="time-vietinbank">27/01/2023 17:20</div>
                                    <div id="output_trade_code-vietinbank" class="trade_code-vietinbank">932S22A1KEPNM5K7</div>
                                    <div id="output_from_number-vietinbank" class="from_number-vietinbank">9999</div>
                                    <div id="output_from_name-vietinbank" class="from_name-vietinbank">NGUYEN TINH</div>
                                    <div id="output_recipient_number-vietinbank" class="recipient_number-vietinbank">999999999</div>
                                    <div id="output_recipient_name-vietinbank" class="recipient_name-vietinbank">NGUYEN TINH</div>
                                    <div id="output_recipient_bank-vietinbank" class="recipient_bank-vietinbank">Ngân hàng Ngoại thương Việt
                                        Nam (VCB)</div>
                                    <div class="recipient_total_number-vietinbank"><span
                                            id="output_total_number-vietinbank">1,000,000,000</span> VND</div>
                                    <div id="output_total_text-vietinbank" class="recipient_total_text-vietinbank">Một Tỷ Đồng</div>
                                    <div class="text_free-vietinbank">Miễn phí</div>
                                    <div id="output_message-vietinbank" class="message-vietinbank">demo bill vietinbank</div>
                                    <?php break;
                                            }
                                            //------------------------- Dữ liệu của VpBank -------------------------
                                    case 12: {
                                        break;
                                    }
                                    default:
                                    } ?>
                                </div>
                                <button class="button_to_img_acb btn btn-warning w-100" id="create_to_img-<?php echo $id ?>">Xuất ảnh hóa
                                    đơn</button>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card" style="margin-top:10px">
                                    <div class="card-body p-4" style="margin:0; padding:0 !important">
                                        <div class="p-2 mt-4">
                                            <div>
                                                <label class="form-label">Đồng hồ <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_clock" placeholder="20:40" style="width: 30%; display: inline-block">
                                            </div>
                                            <div>
                                                <label class="form-label">Số vạch sóng điện thoại <span class="data_auto">(*)</span></label>
                                                <select id="input_sim_waves">
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                            <div style="margin-top:10px">
                                                <label class="form-label">Sóng wifi <span class="data_auto">(*)</span></label>
                                                <select id="input_wifi">
                                                    <option value="3">Wifi</option>
                                                    <option value="1">LTE</option>
                                                    <option value="2">4G</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Phần trăm pin <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_battery_level" placeholder="60">
                                            </div>
                                            <!-- ---------------------------------------------------- ACB ------------------------------------------------------>
                                        <?php if ($id == 1) { ?>
                                            <div>
                                                <label class="form-label">Số tiền chuyển (số)</label>
                                                <input type="" class="form-control" id="input_total_number"
                                                    placeholder="1,000,000,000">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền chuyển (chữ)</label>
                                                <input type="text" class="form-control" id="input_total_text-acb" placeholder="Một tỷ đồng">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngày lập lệnh <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-acb"
                                                    placeholder="11/10/2022 - 20:40:00" value='<?php echo date('d/m/Y - H:i:s') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Ngày hiệu lực <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_day-acb" placeholder="11/10/2022" value='<?php echo date('d/m/Y') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Bên chuyển (tên)</label>
                                                <input type="text" class="form-control" id="input_transferer_name-acb"
                                                    placeholder="NGUYEN HO TUAN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Bên chuyển (số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_transferer_number-acb" placeholder="999999" value='<?php echo mt_rand(10000000, 99999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-acb"
                                                    placeholder="NGUYEN HO TUAN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank-acb"placeholder="ACB - NH TMCP A CHAU">
                                                    <option value="BIDV - NH TMCP DAU TU & PHAT TRIEN">Bidv</option>
                                                    <option value="CTG - NH TMCP CONG THUONG VIET NAM">Vietinbank</option>
                                                    <option value="AGRIBANK - NHTM NN & PT NONG THON">Agribank</option>
                                                    <option value="MB - NH TMCP QUAN DOI">MB Bank</option>
                                                    <option value="TECHOMBANK - NH TMCP KY THUONG">Techcombank</option>
                                                    <option value="SBC - NH TMCP SAI GON THUONG TIN">Sacombank</option>
                                                    <option value="VP - NH TMCP VIET NAM THINH VUONG">Vp Bank</option>
                                                    <option value="ACB - NH TMCP A CHAU">Acb</option>
                                                    <option value="OCB - NH TMCP PHUONG DONG">Ocb</option>
                                                    <option value="TPBANK - NH TMCP TIEN PHONG">Tp Bank</option>
                                                    <option value="VIB - NH TMCP QUOC TE">Vib</option>
                                                    <option value="HD - NH TMCP PHAT TRIEN TPHCM">HD Bank</option>
                                                    <option value="SHBVN - NH TMCP SHINHAN VIET NAM">Shinhan Bank</option>
                                                    <option value="DONG A BANK - NH TMCP DONG A">Dong A Bank</option>
                                                    <option value="BAOVIET BANK - NH TMCP BAO VIET">Bao Viet Bank</option>
                                                    <option value="SHB - NH TMCP SAI GON - HA NOI">SHB</option>
                                                    <option value="MSB - NH TNCP HANG HAI">MSB</option>
                                                    <option value="VIET CAPITAL BANK - NH TMCP BAN VIET">Viet Capital Bank</option>
                                                    <option value="SEABANK - NH TMCP DONG NAM A">SeaBank</option>
                                                    <option value="LPD - NH TMCP LIEN VIET">Lien Viet Post Bank</option>
                                                    <option value="ABBANK - NH TMCP AN BINH">AB Bank</option>
                                                    <option value="EXIMBANK - NH TMCP XUAT NHAP KHAU">Eximbank</option>
                                                    <option value="SCB - NH TMCP SAI GON">(SCB) Sai Gon</option>
                                                    <option value="NCB - NH TMCP QUOC DAN">(NCB) Quoc Dan</option>
                                                    <option value="NAM A BANK - NH TMCP NAM A">Nam A Bank</option>
                                                    <option value="KLB - NH TMCP KIEN LONG">Kien Long Bank</option>
                                                    <option value="PVCOMBANK - NH TMCP DAI CHUNG">PVCOMBANK</option>
                                                    <option value="BAC A BANK - NH TMCP BAC A">Bac A Bank</option>
                                                    <option value="VIET A BANK - NH TMCP VIET A">Viet A Bank</option>
                                                    <option value="SGB - NH TMCP SAI GON CONG THUONG">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Tài khoản nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-acb"
                                                    placeholder="8888888888">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-acb">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>
                                            <!-- ---------------------------------------------------- Agribank ----------------------------------------------------  -->
                                        <?php if ($id == 2) { ?>
                                            <div>
                                                <label class="form-label">Số tiền chuyển</label>
                                                <input type="" class="form-control" id="input_total_number"
                                                    placeholder="1.000.000.000">
                                            </div>
                                            <div>
                                                <label class="form-label">Số thẻ/ Số TK thụ hưởng</label>
                                                <input type="number" class="form-control" id="input_recipient_number-agribank"
                                                    placeholder="1234456789">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người thụ hưởng</label>
                                                <input type="text" class="form-control" id="input_recipient_name-agribank"
                                                    placeholder="NGUYEN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (6 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_trade_code-agribank" placeholder="106706" value='<?php echo mt_rand(100000, 999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank-agribank">
                                                    <option value="Bidv">Bidv</option>
                                                    <option value="Vietinbank">Vietinbank</option>
                                                    <option value="Agribank">Agribank</option>
                                                    <option value="MB Bank">MB Bank</option>
                                                    <option value="Techcombank">Techcombank</option>
                                                    <option value="Sacombank">Sacombank</option>
                                                    <option value="VP Bank">Vp Bank</option>
                                                    <option value="Acb">Acb</option>
                                                    <option value="Ocb">Ocb</option>
                                                    <option value="Tpbank">Tp Bank</option>
                                                    <option value="VIB">Vib</option>
                                                    <option value="HDbank">HD Bank</option>
                                                    <option value="SHBVN">Shinhan Bank</option>
                                                    <option value="DongA Bank">Dong A Bank</option>
                                                    <option value="BaoViet Bank">Bao Viet Bank</option>
                                                    <option value="Shb">SHB</option>
                                                    <option value="Msb">MSB</option>
                                                    <option value="Viet Capital Bank">Viet Capital Bank</option>
                                                    <option value="SeABank">SeaBank</option>
                                                    <option value="LienVietPostBank">Lien Viet Post Bank</option>
                                                    <option value="ABBANK">AB Bank</option>
                                                    <option value="Eximbank">Eximbank</option>
                                                    <option value="Scb">(SCB) Sai Gon</option>
                                                    <option value="Ncb">(NCB) Quoc Dan</option>
                                                    <option value="Nam A Bank">Nam A Bank</option>
                                                    <option value="Kienlongbank">Kien Long Bank</option>
                                                    <option value="PVcomBank">PVCOMBANK</option>
                                                    <option value="Bac A Bank">Bac A Bank</option>
                                                    <option value="Viet A Bank">Viet A Bank</option>
                                                    <option value="Saigonbank">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian giao dịch <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_trade_time-agribank" placeholder="12:29 08/12/2023" value='<?php echo date('H:i d/m/Y') ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-<?php echo $id ?>">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>

                                            <!-- -------------------------------------- BIDV -------------------------------------- -->
                                        <?php if ($id == 3) { ?>
                                            <div>
                                                <label class="form-label">Số tiền chuyển</label>
                                                <input type="text" class="form-control" id="input_total_number"
                                                    placeholder="999,999,999">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_number-bidv"
                                                    placeholder="688686868686868">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-bidv"
                                                    placeholder="NGUYEN TRAN VAN TIN">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank-bidv">
                                                    <option value="NHTMCP Đầu Tư & Phát Triển">Bidv</option>
                                                    <option value="NHTMCP Công Thương">Vietinbank</option>
                                                    <option value="NHTM NN&PT Nông Thôn">Agribank</option>
                                                    <option value="MB Bank">MB Bank</option>
                                                    <option value="NHTMCP Quân Đội">Techcombank</option>
                                                    <option value="NHTMCP Thương Tín">Sacombank</option>
                                                    <option value="NHTMCP VN Thịnh Vượng">Vp Bank</option>
                                                    <option value="NHTMCP Á Châu">Acb</option>
                                                    <option value="NHTMCP Phương Đông">Ocb</option>
                                                    <option value="NHTMCP Tiên Phong">Tp Bank</option>
                                                    <option value="NHTMCP Quốc Tế">Vib</option>
                                                    <option value="NHTMCP PT Nhà TPHCM">HD Bank</option>
                                                    <option value="TNHH MTV Shinhan ">Shinhan Bank</option>
                                                    <option value="NHTMCP Đông Á">Dong A Bank</option>
                                                    <option value="NHTMCP  Bảo Việt">Bao Viet Bank</option>
                                                    <option value="NHTMCP Sài Gòn - Hà Nội">SHB</option>
                                                    <option value="NHTMCP Hàng Hải">MSB</option>
                                                    <option value="NHTM Dầu Khí">Viet Capital Bank</option>
                                                    <option value="NHTMCP Đông Nam Á">SeaBank</option>
                                                    <option value="NHTMCP Liên Việt">Lien Viet Post Bank</option>
                                                    <option value="NHTMCP An Bình">AB Bank</option>
                                                    <option value="NHTMCP Xuất Nhập Khẩu">Eximbank</option>
                                                    <option value="NHTMCP Sài Gòn">(SCB) Sai Gon</option>
                                                    <option value="NHTMCP Quốc Dân">(NCB) Quoc Dan</option>
                                                    <option value="NHTMCP Nam Á">Nam A Bank</option>
                                                    <option value="NHTMCP Kiên Long">Kien Long Bank</option>
                                                    <option value="NHTMCP Đại Chúng">PVCOMBANK</option>
                                                    <option value="NHTMCP Bắc Á">Bac A Bank</option>
                                                    <option value="NHTMCP Việt Á">Viet A Bank</option>
                                                    <option value="NHTMCP Sài Gòn Công Thương">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian chuyển khoản <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-bidv" placeholder="13/03/2023 13:32:32" value='<?php echo date('d/m/Y - H:i:s') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Nội dung chuyển khoản <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_content-bidv" placeholder="3424" value='<?php echo mt_rand(1000, 9999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tham chiếu <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_code_number-bidv" placeholder="143369" value='<?php echo mt_rand(100000, 999999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-bidv">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>
                                            <!------------------------------------------------------ MB Bank ------------------------------------------------------>
                                        <?php if ($id == 4) { ?>
                                            <div>
                                                <label class="form-label">Số tiền chuyển</label>
                                                <input type="text" class="form-control" id="input_total_price-mbbank"
                                                    placeholder="999,999,999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-mbbank"
                                                    placeholder="NGUYEN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản người nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-mbbank"
                                                    placeholder="999999999999999">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank-mbbank">
                                                    <option value="NHTMCP Đầu Tư & Phát Triển">Bidv</option>
                                                    <option value="NHTMCP Công Thương">Vietinbank</option>
                                                    <option value="NHTM NN&PT Nông Thôn">Agribank</option>
                                                    <option value="MB Bank">MB Bank</option>
                                                    <option value="NHTMCP Quân Đội">Techcombank</option>
                                                    <option value="NHTMCP Thương Tín">Sacombank</option>
                                                    <option value="NHTMCP VN Thịnh Vượng">Vp Bank</option>
                                                    <option value="NHTMCP Á Châu">Acb</option>
                                                    <option value="NHTMCP Phương Đông">Ocb</option>
                                                    <option value="NHTMCP Tiên Phong">Tp Bank</option>
                                                    <option value="NHTMCP Quốc Tế">Vib</option>
                                                    <option value="NHTMCP PT Nhà TPHCM">HD Bank</option>
                                                    <option value="TNHH MTV Shinhan ">Shinhan Bank</option>
                                                    <option value="NHTMCP Đông Á">Dong A Bank</option>
                                                    <option value="NHTMCP  Bảo Việt">Bao Viet Bank</option>
                                                    <option value="NHTMCP Sài Gòn - Hà Nội">SHB</option>
                                                    <option value="NHTMCP Hàng Hải">MSB</option>
                                                    <option value="NHTM Dầu Khí">Viet Capital Bank</option>
                                                    <option value="NHTMCP Đông Nam Á">SeaBank</option>
                                                    <option value="NHTMCP Liên Việt">Lien Viet Post Bank</option>
                                                    <option value="NHTMCP An Bình">AB Bank</option>
                                                    <option value="NHTMCP Xuất Nhập Khẩu">Eximbank</option>
                                                    <option value="NHTMCP Sài Gòn">(SCB) Sai Gon</option>
                                                    <option value="NHTMCP Quốc Dân">(NCB) Quoc Dan</option>
                                                    <option value="NHTMCP Nam Á">Nam A Bank</option>
                                                    <option value="NHTMCP Kiên Long">Kien Long Bank</option>
                                                    <option value="NHTMCP Đại Chúng">PVCOMBANK</option>
                                                    <option value="NHTMCP Bắc Á">Bac A Bank</option>
                                                    <option value="NHTMCP Việt Á">Viet A Bank</option>
                                                    <option value="NHTMCP Sài Gòn Công Thương">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Tài khoản nguồn</label>
                                                <input type="number" class="form-control" id="input_source_account-mbbank"
                                                    placeholder="8888888888888">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên tài khoản nguồn</label>
                                                <input type="text" class="form-control" id="input_source_name-mbbank"
                                                    placeholder="NGUYEN TINH NGUYEN">
                                            </div>
                                            <div>
                                                <label class="form-label">Nội dung chuyển khoản</label>
                                                <input type="text" class="form-control" id="input_content-mbbank" placeholder="3424">
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian</label>
                                                <input type="text" class="form-control" id="input_time-mbbank"
                                                    placeholder="18:29:16, 07/01/2023">
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (FT và 14 số)</label>
                                                <input type="text" class="form-control" id="input_code_number-mbbank"
                                                    placeholder="FT22358547622890">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-mbbank">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>
                                            <!-- ---------------------------------------------------- Momo ------------------------------------------------------>
                                        <?php if ($id == 5) { ?>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-momo"
                                                    placeholder="NGUYEN TINH TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên viết tắt ngân hàng nhận</label>
                                                <select class="select" id="input_recipient_bank-momo">
                                                    <option value="BIDV">Bidv</option>
                                                    <option value="VIETINBANK">Vietinbank</option>
                                                    <option value="AGRIBANK">Agribank</option>
                                                    <option value="MB BANK">MB Bank</option>
                                                    <option value="TECHCOMBANK">Techcombank</option>
                                                    <option value="SACOMBANK">Sacombank</option>
                                                    <option value="VP BANK">Vp Bank</option>
                                                    <option value="ACB">Acb</option>
                                                    <option value="OCB">Ocb</option>
                                                    <option value="TP BANK">Tp Bank</option>
                                                    <option value="VIB">Vib</option>
                                                    <option value="HD BANK">HD Bank</option>
                                                    <option value="SHINHAN BANK">Shinhan Bank</option>
                                                    <option value="DONG A BANK">Dong A Bank</option>
                                                    <option value="BAO VIET BANK">Bao Viet Bank</option>
                                                    <option value="SHB">SHB</option>
                                                    <option value="MSB">MSB</option>
                                                    <option value="VIET CAPITAL BANK">Viet Capital Bank</option>
                                                    <option value="SEABANK">SeaBank</option>
                                                    <option value="LIEN VIET POST BANK">Lien Viet Post Bank</option>
                                                    <option value="AB BANK">AB Bank</option>
                                                    <option value="EXIMBANK">Eximbank</option>
                                                    <option value="SCB">(SCB) Sai Gon</option>
                                                    <option value="NCB">(NCB) Quoc Dan</option>
                                                    <option value="NAM A BANK">Nam A Bank</option>
                                                    <option value="KIEN LONG BANK">Kien Long Bank</option>
                                                    <option value="PVCOMBANK">PVCOMBANK</option>
                                                    <option value="BAC A BANK">Bac A Bank</option>
                                                    <option value="VIET A BANK">Viet A Bank</option>
                                                    <option value="SAI GON BANK">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền chuyển</label>
                                                <input class="form-control" id="input_total_price"
                                                    placeholder="50.000.000">
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-momo" placeholder="21:29 - 19/02/2023" value='<?php echo date('H:i - d/m/Y') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (11 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_trade_code-momo" placeholder="35637957291" value='<?php echo mt_rand(10000000000, 99999999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_number-momo"
                                                    placeholder="9999999999999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên chủ thẻ/ người nhận</label>
                                                <input type="text" class="form-control" id="input_banking_name-momo"
                                                    placeholder="NGUYEN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_banking_bank-momo">
                                                    <option value="NH TMCP Dau Tu & Phat Trien (BIDV)">Bidv</option>
                                                    <option value="NH TMCP Cong Thuong (CTG)">Vietinbank</option>
                                                    <option value="NH TMDT & PT Nong Thon (AGRIBANK)">Agribank</option>
                                                    <option value="NH TMCP Quan Doi (MB)">MB Bank</option>
                                                    <option value="NH TMCP Ky Thuong (TECHCOMBANK)">Techcombank</option>
                                                    <option value="NH TMCP Thương Tín(SACOMBANK)">Sacombank</option>
                                                    <option value="NH TMCP VN Thịnh Vượng (VPB)">Vp Bank</option>
                                                    <option value="NH TMCP Á Châu (ACB)">Acb</option>
                                                    <option value="NH TMCP Phương Đông (OCB)">Ocb</option>
                                                    <option value="NH TMCP Tiên Phong (TPB)">Tp Bank</option>
                                                    <option value="NH TMCP Quốc Tế (VIB)">Vib</option>
                                                    <option value="NH TMCP PT Nhà TPHCM (HDB)">HD Bank</option>
                                                    <option value="NH TNHH MTV Shinhan (SHINHAN)">Shinhan Bank</option>
                                                    <option value="NH TMCP Đông Á (DONG A BANK)">Dong A Bank</option>
                                                    <option value="NH TMCP Bảo Việt (BAOVIET BANK)">Bao Viet Bank</option>
                                                    <option value="NH TMCP Sài Gòn - Hà Nội (SHB)">SHB</option>
                                                    <option value="NH TMCP Hàng Hải (MSB)">MSB</option>
                                                    <option value="NH TMCP Bản Việt (BVB)">Viet Capital Bank</option>
                                                    <option value="NH TMCP Đông Nam Á (SSB)">SeaBank</option>
                                                    <option value="NH TMCP Liên Việt (LPB)">Lien Viet Post Bank</option>
                                                    <option value="NH TMCP An Bình (ABB)">AB Bank</option>
                                                    <option value="NH TMCP Xuất Nhập Khẩu (EIB)">Eximbank</option>
                                                    <option value="NH TMCP Sài Gòn (SBC)">(SCB) Sai Gon</option>
                                                    <option value="NH TMCP Quốc Dân (NCB)">(NCB) Quoc Dan</option>
                                                    <option value="NH TMCP Nam Á Bank (NAB)">Nam A Bank</option>
                                                    <option value="NH TMCP Kiên Long (KLB)">Kien Long Bank</option>
                                                    <option value="NH TMCP Đại Chúng (PVCOMBANK)">PVCOMBANK</option>
                                                    <option value="NH TMCP Bắc Á Bank (BAB)">Bac A Bank</option>
                                                    <option value="NH TMCP Việt Á Bank (VAB)">Viet A Bank</option>
                                                    <option value="NH TMCP Sài Gòn Công Thương (SGB)">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Lời nhắn <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-momo" placeholder="3424" value='<?php echo mt_rand(1000, 9999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-momo">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>

                                            <!------------------------------------------ MSB ------------------------------------->
                                        <?php if ($id == 6) { ?>
                                            <div>
                                                <label class="form-label">Tên người chuyển</label>
                                                <input type="text" class="form-control" id="input_holder_name-msb"
                                                    placeholder="Nguyen Tinh">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền</label>
                                                <input class="form-control" id="input_total_number"
                                                    placeholder="1,000,000,000">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản thụ hưởng</label>
                                                <input type="number" class="form-control" id="input_recipient_number-msb"
                                                    placeholder="999999999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người thụ hưởng</label>
                                                <input type="text" class="form-control" id="input_recipient_name-msb"
                                                    placeholder="NGUYEN HO TUAN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Nội dung chuyển khoản <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-msb" placeholder="Demo Bill MSB" value='<?php echo mt_rand(1000, 9999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-msb">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>

                                            <!-------------------------------------------- Sacombank  ----------------------------------->
                                        <?php if ($id == 7) { ?>
                                            <div>
                                                <label class="form-label">Số tài khoản người nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-sacombank"
                                                    placeholder="400041000348615">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-sacombank"
                                                    placeholder="NGUYEN HO TUAN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền chuyển</label>
                                                <input type="text" class="form-control" id="input_total_number"
                                                    placeholder="1,000,000,000">
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian chuyển tiền <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-sacombank" placeholder="14:09:47 08/02/2023" value='<?php echo date('h:i:s d/m/Y') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (10 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_trade_code-sacombank" placeholder="3872493694" value='<?php echo mt_rand(1000000000, 9999999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản người chuyển (12 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_from_number-sacombank" placeholder="400041000348" value='<?php echo "0" . mt_rand(10000000000, 99999999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select class="select" id="input_recipient_bank-sacombank">
                                                    <option value="Bidv">Bidv</option>
                                                    <option value="Vietinbank">Vietinbank</option>
                                                    <option value="Agribank">Agribank</option>
                                                    <option value="MB Bank">MB Bank</option>
                                                    <option value="Techcombank">Techcombank</option>
                                                    <option value="Sacombank">Sacombank</option>
                                                    <option value="VP Bank">Vp Bank</option>
                                                    <option value="Acb">Acb</option>
                                                    <option value="Ocb">Ocb</option>
                                                    <option value="Tpbank">Tp Bank</option>
                                                    <option value="VIB">Vib</option>
                                                    <option value="HDbank">HD Bank</option>
                                                    <option value="SHBVN">Shinhan Bank</option>
                                                    <option value="DongA Bank">Dong A Bank</option>
                                                    <option value="BaoViet Bank">Bao Viet Bank</option>
                                                    <option value="Shb">SHB</option>
                                                    <option value="Msb">MSB</option>
                                                    <option value="Viet Capital Bank">Viet Capital Bank</option>
                                                    <option value="SeABank">SeaBank</option>
                                                    <option value="LienVietPostBank">Lien Viet Post Bank</option>
                                                    <option value="ABBANK">AB Bank</option>
                                                    <option value="Eximbank">Eximbank</option>
                                                    <option value="Scb">(SCB) Sai Gon</option>
                                                    <option value="Ncb">(NCB) Quoc Dan</option>
                                                    <option value="Nam A Bank">Nam A Bank</option>
                                                    <option value="Kienlongbank">Kien Long Bank</option>
                                                    <option value="PVcomBank">PVCOMBANK</option>
                                                    <option value="Bac A Bank">Bac A Bank</option>
                                                    <option value="Viet A Bank">Viet A Bank</option>
                                                    <option value="Saigonbank">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Diễn giải <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-sacombank" placeholder="demo bill Sacombank" value='<?php echo mt_rand(1000,9999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-sacombank">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>
                                            <!-------------------------------- Techcombank  -------------------------->
                                        <?php if ($id == 8) { ?>
                                            <div>
                                                <label class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-techcombank"
                                                    placeholder="Nguyen Tinh">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền</label>
                                                <input type="text" class="form-control" id="input_total_number" placeholder="99,999,999,999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank-techcombank">
                                                    <option value="Ngân hàng TMCP Đầu tư & Phát triển">Bidv</option>
                                                    <option value="Ngân hàng TMCP Công thương Việt Nam">Vietinbank</option>
                                                    <option value="Ngân hàng NN&PT Nông Thôn Việt Nam">Agribank</option>
                                                    <option value="Ngân hàng TMCP Quân Đội Việt Nam">MB Bank</option>
                                                    <option value="Ngân hàng TMCP Kỹ thương Việt Nam">Techcombank</option>
                                                    <option value="Ngân hàng TMCP Sài Gòn thương tín">Sacombank</option>
                                                    <option value="Ngân hàng TMCP Việt Nam thịnh vượng">Vp Bank</option>
                                                    <option value="Ngân hàng TMCP Á Châu">Acb</option>
                                                    <option value="Ngân hàng TMCP Phương Đông">Ocb</option>
                                                    <option value="Ngân hàng TMCP Tiên Phong">Tp Bank</option>
                                                    <option value="Ngân hàng TMCP Quốc tế Việt Nam">Vib</option>
                                                    <option value="Ngân hàng TMCP Phát triển nhà">HD Bank</option>
                                                    <option value="Ngân hàng TNHH MTV Shinhan Việt Nam ">Shinhan Bank</option>
                                                    <option value="Ngân hàng TMCP Đông Á">Dong A Bank</option>
                                                    <option value="Ngân hàng TMCP Bảo Việt">Bao Viet Bank</option>
                                                    <option value="Ngân hàng TMCP Sài Gòn - Hà Nội">SHB</option>
                                                    <option value="Ngân hàng TMCP Hàng Hải Việt Nam">MSB</option>
                                                    <option value="Ngân hàng TMCP Bản Việt">Bản Việt</option>
                                                    <option value="Ngân hàng TMCP Đông Nam Á">SeaBank</option>
                                                    <option value="Ngân hàng TMCP Liên Việt">Lien Viet Post Bank</option>
                                                    <option value="Ngân hàng TMCP An Bình">AB Bank</option>
                                                    <option value="Ngân hàng TMCP Xuất nhập khẩu Việt Nam">Eximbank</option>
                                                    <option value="Ngân hàng TMCP Sài Gòn">(SCB) Sai Gon</option>
                                                    <option value="Ngân hàng TMCP Quốc Dân">(NCB) Quoc Dan</option>
                                                    <option value="Ngân hàng TMCP Nam Á">Nam A Bank</option>
                                                    <option value="Ngân hàng TMCP Kiên Long">Kien Long Bank</option>
                                                    <option value="Ngân hàng TMCP Đại chúng Việt Nam">PVCOMBANK</option>
                                                    <option value="Ngân hàng TMCP Bắc Á">Bac A Bank</option>
                                                    <option value="Ngân hàng TMCP Việt Á">Viet A Bank</option>
                                                    <option value="Ngân hàng TMCP Sài Gòn Công Thương">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản Ngân hàng nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-techcombank"
                                                    placeholder="8989 8989 898">
                                            </div>
                                            <div>
                                                <label class="form-label">Lời nhắn <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-techcombank" placeholder="Demo bill Techcombank" value='<?php echo mt_rand(1000,9999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Thời gian <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-techcombank" placeholder="18 tháng 3, 2023" value='<?php echo date('d') . " tháng " . date('m, Y')?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (14 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_trade_code-techcombank" placeholder="22288197735763" maxlength="14" value='<?php echo mt_rand(10000000000000,99999999999999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-techcombank">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>

                                            <!------------------------------ Vietcombank  -------------------------->
                                        <?php if ($id == 10) { ?>
                                            <div>
                                                <label class="form-label">Số tiền </label>
                                                <input type="text" class="form-control" id="input_total_number"
                                                    placeholder="999,999,999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người thụ hưởng</label>
                                                <input type="text" class="form-control" id="input_recipient_name-vietcombank"
                                                    placeholder="NGUYEN HO TUAN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản Ngân hàng nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-vietcombank"
                                                    placeholder="9999999999999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên Ngân hàng nhận</label>
                                                <select type="text" class="select" id="input_recipient_bank_name-vietcombank">
                                                    <option value="Ngân hàng Đầu tư & Phát triển (BIDV)">Bidv</option>
                                                    <option value="Ngân hàng Công thương (CTG)">Vietinbank</option>
                                                    <option value="Ngân hàng NN & PT Nông Thôn (AGRIBANK)">Agribank</option>
                                                    <option value="Ngân hàng Quân Đội (MB)">MB Bank</option>
                                                    <option value="Ngân hàng Kỹ thương (TECHCOMBANK)">Techcombank</option>
                                                    <option value="Ngân hàng Sài Gòn thương tín (STB)">Sacombank</option>
                                                    <option value="Ngân hàng Việt Nam thịnh vượng (VPBANK)">Vp Bank</option>
                                                    <option value="Ngân hàng Á Châu (ACB)">Acb</option>
                                                    <option value="Ngân hàng Phương Đông (OCB)">Ocb</option>
                                                    <option value="Ngân hàng Tiên Phong (TPBANK)">Tp Bank</option>
                                                    <option value="Ngân hàng Quốc tế Việt Nam (VIB)">Vib</option>
                                                    <option value="Ngân hàng Phát triển nhà (HDBANK)">HD Bank</option>
                                                    <option value="Ngân hàng Shinhan Việt Nam (Shinhan)">Shinhan Bank</option>
                                                    <option value="Ngân hàng Đông Á (Dong A Bank)">Dong A Bank</option>
                                                    <option value="Ngân hàng Bảo Việt (Bao Viet Bank)">Bao Viet Bank</option>
                                                    <option value="Ngân hàng Sài Gòn - Hà Nội (SHB)">SHB</option>
                                                    <option value="Ngân hàng Hàng Hải Việt Nam (MSB)">MSB</option>
                                                    <option value="Ngân hàng Bản Việt (BVB)">Bản Việt</option>
                                                    <option value="Ngân hàng Đông Nam Á (SSB)">(SeaBank) Đông Nam Á</option>
                                                    <option value="Ngân hàng Liên Việt (LPB)">Lien Viet Post Bank</option>
                                                    <option value="Ngân hàng An Bình (ABBANK)">AB Bank</option>
                                                    <option value="Ngân hàng Xuất nhập khẩu Việt Nam (EIB)">Eximbank</option>
                                                    <option value="Ngân hàng Sài Gòn (SCB)">(SCB) Sai Gon</option>
                                                    <option value="Ngân hàng Quốc Dân (NCB)">(NCB) Quoc Dan</option>
                                                    <option value="Ngân hàng Nam Á (NAB)">Nam A Bank</option>
                                                    <option value="Ngân hàng Kiên Long (KLB)">Kien Long Bank</option>
                                                    <option value="Ngân hàng Đại Chúng (PVCOMBANK)">(PVCOMBANK) Đại chúng Việt Nam</option>
                                                    <option value="Ngân hàng Sài Gòn Công Thương (SGB)">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Mã Ngân hàng nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_bank_code-vietcombank" placeholder="MB">
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (10 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_trade_code-vietcombank" placeholder="2616042867" value='<?php echo mt_rand(1000000000,9999999999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Nội dung <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-vietcombank" placeholder="demo bill" value='<?php echo mt_rand(1000,9999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-vietcombank">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>

                                        <?php if ($id == 11) { ?>
                                            <div>
                                                <label class="form-label">Thời gian chuyển tiền <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_time-vietinbank" placeholder="27/01/2023 17:20" value='<?php echo date('d/m/Y H:i') ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Mã giao dịch (932S22A1KEPNM5K7) <span class="data_auto">(*)</span></label>
                                                <?php
                                                    // Tạo một chuỗi ngẫu nhiên gồm 16 ký tự
                                                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    $random_string = '';
                                                    for ($i = 0; $i < 16; $i++) {
                                                        $index = mt_rand(0, strlen($characters) - 1);
                                                        $random_string .= $characters[$index];
                                                    }
                                                ?>
                                                <input type="text" class="form-control" id="input_trade_code-vietinbank" placeholder="932S22A1KEPNM5K7" value='<?php echo $random_string ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản người chuyển (4 số) <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control" id="input_from_number-vietinbank" placeholder="9999" value='<?php echo mt_rand(1000,9999) ?>'>
                                            </div>
                                            <div>
                                                <label class="form-label">Tên người chuyển</label>
                                                <input type="text" class="form-control" id="input_from_name-vietinbank"
                                                    placeholder="NGUYEN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tài khoản người nhận</label>
                                                <input type="number" class="form-control" id="input_recipient_number-vietinbank"
                                                    placeholder="999999999">
                                            </div>
                                            <div>
                                                <label class="form-label">Tên tài khoản người nhận</label>
                                                <input type="text" class="form-control" id="input_recipient_name-vietinbank"
                                                    placeholder="NGUYEN TINH">
                                            </div>
                                            <div>
                                                <label class="form-label">Ngân hàng nhận</label>
                                                <select class="select" id="input_recipient_bank-vietinbank">
                                                    <option value="Ngân hàng Đầu tư & Phát triển (BIDV)">Bidv</option>
                                                    <option value="Ngân hàng Công thương (CTG)">Vietinbank</option>
                                                    <option value="Ngân hàng NN & PT Nông Thôn (AGRIBANK)">Agribank</option>
                                                    <option value="Ngân hàng Quân Đội (MB)">MB Bank</option>
                                                    <option value="Ngân hàng Kỹ thương (TECHCOMBANK)">Techcombank</option>
                                                    <option value="Ngân hàng Sài Gòn thương tín (STB)">Sacombank</option>
                                                    <option value="Ngân hàng Việt Nam thịnh vượng (VPBANK)">Vp Bank</option>
                                                    <option value="Ngân hàng Á Châu (ACB)">Acb</option>
                                                    <option value="Ngân hàng Phương Đông (OCB)">Ocb</option>
                                                    <option value="Ngân hàng Tiên Phong (TPBANK)">Tp Bank</option>
                                                    <option value="Ngân hàng Quốc tế Việt Nam (VIB)">Vib</option>
                                                    <option value="Ngân hàng Phát triển nhà (HDBANK)">HD Bank</option>
                                                    <option value="Ngân hàng Shinhan Việt Nam (Shinhan)">Shinhan Bank</option>
                                                    <option value="Ngân hàng Đông Á (Dong A Bank)">Dong A Bank</option>
                                                    <option value="Ngân hàng Bảo Việt (Bao Viet Bank)">Bao Viet Bank</option>
                                                    <option value="Ngân hàng Sài Gòn - Hà Nội (SHB)">SHB</option>
                                                    <option value="Ngân hàng Hàng Hải Việt Nam (MSB)">MSB</option>
                                                    <option value="Ngân hàng Bản Việt (BVB)">Bản Việt</option>
                                                    <option value="Ngân hàng Đông Nam Á (SSB)">(SeaBank) Đông Nam Á</option>
                                                    <option value="Ngân hàng Liên Việt (LPB)">Lien Viet Post Bank</option>
                                                    <option value="Ngân hàng An Bình (ABBANK)">AB Bank</option>
                                                    <option value="Ngân hàng Xuất nhập khẩu Việt Nam (EIB)">Eximbank</option>
                                                    <option value="Ngân hàng Sài Gòn (SCB)">(SCB) Sai Gon</option>
                                                    <option value="Ngân hàng Quốc Dân (NCB)">(NCB) Quoc Dan</option>
                                                    <option value="Ngân hàng Nam Á (NAB)">Nam A Bank</option>
                                                    <option value="Ngân hàng Kiên Long (KLB)">Kien Long Bank</option>
                                                    <option value="Ngân hàng Bắc Á (BAB)">Bắc Á Bank</option>
                                                    <option value="Ngân hàng Việt Á (VAB)">Việt Á Bank</option>
                                                    <option value="Ngân hàng Đại Chúng (PVCOMBANK)">(PVCOMBANK) Đại chúng Việt Nam</option>
                                                    <option value="Ngân hàng Sài Gòn Công Thương (SGB)">SAIGON Bank</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền (số)</label>
                                                <input type="text" class="form-control" id="input_total_number"
                                                    placeholder="1,000,000,000">
                                            </div>
                                            <div>
                                                <label class="form-label">Số tiền (chữ)</label>
                                                <input type="text" class="form-control" id="input_total_text-vietinbank"
                                                    placeholder="Một Tỷ Đồng">
                                            </div>
                                            <div>
                                                <label class="form-label">Nội dung <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control" id="input_message-vietinbank" placeholder="demo bill vietinbank" value='<?php echo mt_rand(1000,9999) ?>'>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="create_bill-vietinbank">Tạo hóa đơn mới</button>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        <div style="color:red; text-align:center">
                                            <i >Những mục đánh dấu (*) là dữ liệu tạo tự động, có thể chỉnh sửa nếu cần thiết</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div id="convert_photo" class="demo_image-container" bis_skin_checked="1">
                                    <img class="photo_style" src="photo/<?php echo $value['phot_demo'] ?>" alt="Demo bill" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Mg188.zone
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Bill
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>
    <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
            <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

            <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="p-4">
                    <h6 class="mb-0 fw-semibold text-uppercase">Layout</h6>
                    <p class="text-muted">Choose your layout</p>

                    <div class="row gy-3">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout01">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Vertical</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout02">
                                    <span class="d-flex h-100 flex-column gap-1">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                            <span class="d-block p-1 bg-soft-primary rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-soft-primary ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-soft-primary"></span>
                                        </span>
                                        <span class="bg-light d-block p-1"></span>
                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Horizontal</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout03" name="data-layout" type="radio" value="twocolumn" class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout03">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Two Column</h5>
                        </div>
                        <!-- end col -->

                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout04" name="data-layout" type="radio" value="semibox" class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout04">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0 p-1">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column pt-1 pe-2">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Semi Box</h5>
                        </div>
                        <!-- end col -->
                    </div>

                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Color Scheme</h6>
                    <p class="text-muted">Choose Light or Dark Scheme.</p>

                    <div class="colorscheme-cardradio">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-light">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Light</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check card-radio dark">
                                    <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100 bg-dark" for="layout-mode-dark">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-soft-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-soft-light d-block p-1"></span>
                                                    <span class="bg-soft-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Dark</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-visibility">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Visibility</h6>
                        <p class="text-muted">Choose show or Hidden sidebar.</p>
                
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-visibility" id="sidebar-visibility-show" value="show">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-visibility-show">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0 p-1">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column pt-1 pe-2">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Show</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-visibility" id="sidebar-visibility-hidden" value="hidden">
                                    <label class="form-check-label p-0 avatar-md w-100 px-2" for="sidebar-visibility-hidden">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column pt-1 px-2">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Hidden</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Width</h6>
                        <p class="text-muted">Choose Fluid or Boxed layout.</p>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-fluid" value="fluid">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-width-fluid">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Fluid</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-boxed" value="boxed">
                                    <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-width-boxed">
                                        <span class="d-flex gap-1 h-100 border-start border-end">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Boxed</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Position</h6>
                        <p class="text-muted">Choose Fixed or Scrollable Layout Position.</p>

                        <div class="btn-group radio" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                            <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Topbar Color</h6>
                    <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Light</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-primary d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Dark</h5>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Size</h6>
                        <p class="text-muted">Choose a size of Sidebar.</p>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-default" value="lg">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-default">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Default</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-compact" value="md">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-compact">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Compact</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small" value="sm">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-small">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1">
                                                    <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Small (Icon View)</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-small-hover">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1">
                                                    <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Small Hover View</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-view">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar View</h6>
                        <p class="text-muted">Choose Default or Detached Sidebar view.</p>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-default" value="default">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-view-default">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Default</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-detached" value="detached">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-view-detached">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-flex p-1 gap-1 align-items-center px-2">
                                                <span class="d-block p-1 bg-soft-primary rounded me-1"></span>
                                                <span class="d-block p-1 pb-0 px-2 bg-soft-primary ms-auto"></span>
                                                <span class="d-block p-1 pb-0 px-2 bg-soft-primary"></span>
                                            </span>
                                            <span class="d-flex gap-1 h-100 p-1 px-2">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Detached</h5>
                            </div>
                        </div>
                    </div>
                    <div id="sidebar-color">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Color</h6>
                        <p class="text-muted">Choose a color of Sidebar.</p>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-light">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Light</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-dark">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Dark</h5>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient" aria-expanded="false" aria-controls="collapseBgGradient">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </button>
                                <h5 class="fs-13 text-center mt-2">Gradient</h5>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="collapse" id="collapseBgGradient">
                            <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient" value="gradient">
                                    <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient">
                                        <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                    </label>
                                </div>
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-2" value="gradient-2">
                                    <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-2">
                                        <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                    </label>
                                </div>
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-3" value="gradient-3">
                                    <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-3">
                                        <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                    </label>
                                </div>
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-4" value="gradient-4">
                                    <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-4">
                                        <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-img">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Images</h6>
                        <p class="text-muted">Choose a image of Sidebar.</p>

                        <div class="d-flex gap-2 flex-wrap img-switch">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-none" value="none">
                                <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-none">
                                    <span class="avatar-md w-auto bg-light d-flex align-items-center justify-content-center">
                                        <i class="ri-close-fill fs-20"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-01" value="img-1">
                                <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-01">
                                    <img src="assets/images/sidebar/img-1.jpg" alt="" class="avatar-md w-auto object-cover">
                                </label>
                            </div>	

                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-02" value="img-2">
                                <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-02">
                                    <img src="assets/images/sidebar/img-2.jpg" alt="" class="avatar-md w-auto object-cover">
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-03" value="img-3">
                                <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-03">
                                    <img src="assets/images/sidebar/img-3.jpg" alt="" class="avatar-md w-auto object-cover">
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-04" value="img-4">
                                <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-04">
                                    <img src="assets/images/sidebar/img-4.jpg" alt="" class="avatar-md w-auto object-cover">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="preloader-menu">
                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Preloader</h6>
                        <p class="text-muted">Choose a preloader.</p>
                    
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-custom" value="enable">
                                    <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-custom">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                        <!-- <div id="preloader"> -->
                                        <div id="status" class="d-flex align-items-center justify-content-center">
                                            <div class="spinner-border text-primary avatar-xxs m-auto" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Enable</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-none" value="disable">
                                    <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-none">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Disable</h5>
                            </div>
                        </div>
                    
                    </div>
                    <!-- end preloader-menu -->

                </div>
            </div>

        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/glightbox/js/glightbox.min.js"></script>
    <script src="assets/libs/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/js/pages/gallery.init.js"></script>
    <script src="assets/js/app.js"></script>

</body>









</html>