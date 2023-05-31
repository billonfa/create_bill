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
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                include_once '../connect.php';
                // Câu truy vấn SQL để lấy dữ liệu
                $sql2 = "SELECT * FROM withdrawal WHERE id = '$id'";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/libs/glightbox/css/glightbox.min.css">
    <script src="../assets/js/layout.js"></script>
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script async src="../assets/js/html2canvas.min.js"></script>
    <script async src="../assets/js/FileSaver.min.js"></script>
    
    <link rel="stylesheet" href="styles.css">
    <title>ONFA - <?php echo $value['name'] ?></title>
</head>
<body>
    

    <!-- <div class="ruler"></div>
    <div class="ruler_doc"></div>
    <div class="ruler_doc2"></div> -->
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
        <div class="modal" id="modal">
            <div class="modal-content">
                <h2>Vui lòng nhấn Ctrl + F5 để refresh trang</h2>
                <p>Đã xảy ra lỗi trong quá trình xử lý. Vui lòng nhấn CTRL + F5</p>
            </div>
        </div>
        <script>
            // Lấy ngày hiện tại
            var currentDate = new Date().toLocaleDateString();

            // Kiểm tra xem người dùng đã đăng nhập lần đầu trong ngày hay chưa
            if (localStorage.getItem('lastLoginDate') === currentDate) {
                document.querySelector('#modal').style.display = 'none'
            } else {
                document.querySelector('#modal').style.display = 'block'
                // Lưu thông tin đăng nhập vào localStorage
                localStorage.setItem('lastLoginDate', currentDate);
            }
        </script>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex align-items-center">
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
                                <a class="dropdown-item" href="../reset_password.php"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Đổi mật khẩu</span></a>
                                <a class="dropdown-item" href="../logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Đăng xuất</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header> 
    <div class="app-menu navbar-menu" style="background: #000033;">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="#" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="../assets/images/logo_onfa.png" alt="" height="60" />
                </span>
                <span class="logo-lg">
                    <img src="../assets/images/logo_onfa.png" alt="" height="60" />
                </span>
            </a>
            <!-- Light Logo-->
            <a href="#" class="logo logo-light">
                <span class="logo-sm">
                    <img src="../assets/images/logo_onfa.png" alt="" height="60" />
                </span>
                <span class="logo-lg">
                    <img src="../assets/images/logo_onfa.png" alt="" height="60" />
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
                        <a class="nav-link menu-link" href="../create-withdrawal">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill rút tiền</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="../create-bet">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Bill đơn cược</span>
                        </a>
                    </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>


        <div class="main-content" style='background:#c7c5c5'>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"><?php echo $value['name'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container_box" bis_skin_checked="1">
                            <div class="box">
                                <div class="create-image-container" id="new_bill<?php echo $id ?>">
                                    <img class="photo_style" src="photo-withdrawal/<?php echo $value['photo'] ?>" alt="Demo bill" />
                                    <?php $rand_icon = rand(1,3); ?>
                                    <div id="output_clock" class="time-bet1<?php if($id==3) echo '-mg' ?>">20:40</div>
                                    <span <?php echo ($rand_icon == 3) ? "style=display:none" : '' ?> id="custom-icon" class="custom-icon2<?php if($id==3) echo '-mg' ?>"><img style="width:100%" src='../photo/<?php echo ($rand_icon == 1) ? 'location_black.png' : 'clock_black.png' ?>' /></span>
                                    
                                    <div id="output_signal_invi" class="signal<?php if($id == 3) echo '-mg' ?>">
                                        <div class="bar background_invi"></div>
                                        <div class="bar background_invi"></div>
                                        <div class="bar background_invi"></div>
                                        <div class="bar background_invi"></div>
                                        <!-- <img src="photo/may_bay.png"/> -->
                                    </div>
                                    <div id="output_signal" class="signal<?php if($id == 3) echo '-mg' ?>" >
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <div class="bar background_black"></div>
                                        <!-- <img src="photo/may_bay.png"/> -->
                                    </div>
                                    <div id="output_signal-1" class="signal-1<?php if($id == 3) echo '-mg' ?>" style="display:none">
                                        <div class="bar-1 background_black"></div>
                                        <div class="bar-1 background_black"></div>
                                        <div class="bar-1 background_black"></div>
                                        <div class="bar-1 background_black"></div>
                                        <!-- <img src="photo/may_bay.png"/> -->
                                    </div>
                                    <div id="output_signal2" class="signal2<?php if($id == 3) echo '-mg' ?>" style="display:none">
                                        <div class="bar2 background_black"></div>
                                        <div class="bar2 background_black"></div>
                                        <div class="bar2 background_black"></div>
                                        <div class="bar2 background_black"></div>
                                    </div>
                                    <div id="output_wifi" class="wifi<?php if($id == 3) echo '-mg' ?>">
                                        <span><img class="img_wifi" src="../photo/icon_wifi_black.jpg" /></span>
                                    </div>
                                    <div id="output_battery_level" class="background_black battery-level<?php if($id == 2) echo "-3"; if($id == 3) echo '-mg' ?> "></div>
                                    <?php
                                        $rand_icon = rand(1,3);
                                    switch ($id) {
                                            //------------------------- Dữ liệu đơn rút tiền Bongvip -------------------------
                                        case 1: { ?>
                                            <div id="date-b1" class="date-b1">05/07 - 05/07</div>
                                            <div id="bank_name-b1" class="bank_name-b1">AGRIBANK</div>
                                            <div id="detail_date-b1" class="total_date-b1">2023-05-07 06:28:00</div>
                                            <div class="total_price-b1"><span id="total_price-b1">8,000</span>.00</div>
                                            <div id="trade_code-b1" class="trade_code-b1">1227151265</div>
                                            <div id="trade_status-b1" class="trade_status-b1">Rút tiền thành công</div>
                                            <div class="total_price2"><span id="total_price2">8,000</span>.00</div>
                                            <div class="page_number-b1"><?php echo rand(1,20) ?></div>
                                            <?php break;
                                        }
                                            //------------------------- Dữ liệu đơn cược 3 -------------------------
                                        case 2: { ?>
                                            <div id="date-b3" class="date-b3">05/07 - 05/07</div>
                                            <div id="sanh-b3" class="sanh-b3">DG</div>

                                            <div class="g1-b3">
                                                <div id="name_g1-b3" class="name_g1-b3">Baccarat</div>
                                                <div id="time_g1-b3" class="time_g1-b3"><?php echo date("Y-m-d H:i:s") ?></div>
                                                <div id="trade_code_g1-b3"><?php $rand = rand(10000000000, 99999999999); echo $rand; ?></div>
                                                <div class="stdc"><span class="out_price_g1-b3">200</span>.00</div>
                                                <div class="dchl"><span class="out_price_g1-b3">200</span>.00</div>
                                                <div class="price_g1-b3"><span class="out_price_g1-b3">200</span>.00</div>
                                                <div class="total_price_g1-b3"><span id="total_price_g1-b3">400</span><span class="togger">.00</span></div>
                                            </div>
                                            <div class="g2-b3">
                                                <div id="name_g2-b3" class="name_g2-b3">Baccarat</div>
                                                <div id="time_g2-b3" class="time_g2-b3"><?php echo date("Y-m-d H:i:s") ?></div>
                                                <div id="trade_code_g2-b3"><?php echo ($rand - rand(500, 1000)) ?></div>
                                                <div class="stdc-2"><span class="out_price_g2-b3">200</span>.00</div>
                                                <div class="dchl-2"><span class="out_price_g2-b3">200</span>.00</div>
                                                <div class="price_g2-b3"><span class="out_price_g2-b3">200</span>.00</div>
                                                <div class="total_price_g2-b3"><span id="total_price_g2-b3">400</span><span class="togger2">.00</span></div>
                                            </div>
                                            <div class="g3-b3">
                                                <div id="name_g3-b3" class="name_g3-b3">Baccarat</div>
                                                <div id="time_g3-b3" class="time_g3-b3"><?php echo date("Y-m-d H:i:s") ?></div>
                                                <div id="trade_code_g3-b3"><?php echo ($rand - rand(3000, 10000)) ?></div>
                                                <div class="stdc-3"><span class="out_price_g3-b3">200</span>.00</div>
                                                <div class="dchl-3"><span class="out_price_g3-b3">200</span>.00</div>
                                                <div class="price_g3-b3"><span class="out_price_g3-b3">200</span>.00</div>
                                                <div class="total_price_g3-b3"><span id="total_price_g3-b3">400</span><span class="togger3">.00</span></div>
                                            </div>
                                            <?php break;
                                        }
                                            //------------------------- Dữ liệu đơn rút tiền MG188 -------------------------
                                        case 3: { ?>
                                            <div class="pin_number" style="display:none;">100</div>
                                            <div class="bill1-mg">
                                                <div id="trade_code1-mg" class="trade_code1-mg"><u><?php echo 'G168' . rand(10000000000,99999999999) . '600086736' . rand(10000,99999) ?></u></div>
                                                <div id="time_mg1-mg" class="time_mg1-mg">2023-05-20 15:00:37</div>
                                                <div class="price_mg1-mg"><span id="price_mg1-mg"><?php echo rand(1,50) * 100 ?></span>.00</div>
                                                <div id="status_mg1_1-mg">Thành Công</div>
                                                <div id="status_mg2_1-mg">thành công</div>
                                            </div>

                                            <div class="bill2-mg">
                                                <div id="trade_code2-mg" class="trade_code2-mg"><u><?php echo 'G168' . rand(10000000000,99999999999) . '600086736' . rand(10000,99999) ?></u></div>
                                                <div id="time_mg2-mg" class="time_mg2-mg"><?php echo date("Y-m-d H:i:s") ?></div>
                                                <div class="price_mg2-mg"><span id="price_mg2-mg"><?php echo rand(1,50) * 100 ?></span>.00</div>
                                                <div id="status_mg1_2-mg">Thành Công</div>
                                                <div id="status_mg2_2-mg">thành công</div>
                                            </div>

                                            <div class="bill3-mg">
                                                <div id="trade_code3-mg" class="trade_code3-mg"><u><?php echo 'G168' . rand(10000000000,99999999999) . '600086736' . rand(10000,99999) ?></u></div>
                                                <div id="time_mg3-mg" class="time_mg3-mg"><?php echo date("Y-m-d H:i:s") ?></div>
                                                <div class="price_mg3-mg"><span id="price_mg3-mg"><?php echo rand(1,50) * 100 ?></span>.00</div>
                                            </div>
                                            <div class="number_page"><?php echo rand(1,9) ?></div>
                                            <?php break; 
                                        } ?>
                                    <?php default:
                                    } ?>
                                </div>
                                <button class="button_to_img_acb btn btn-warning w-100" style="margin-top:10px" id="create_to_img-<?php echo $id ?>">Xuất ảnh đơn cược</button>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-3" <?php if($id == 2 || $id == 3) echo "style='width:500px'" ?>>
                                <div class="card" style="margin-top:10px">
                                    <div class="card-body p-4" style="margin:0; padding:0 !important">
                                        <div class="p-2 mt-4">
                                            <div>
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Đồng hồ <span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control<?php if($id == 2 || $id == 3) echo '-2' ?>" id="input_clock" value="<?php echo date('H:i') ?>">
                                            </div>
                                            <div <?php echo ($id == 3) ? "style='display:block'" : "style='display:none'" ?>>
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Số vạch sóng điện thoại <span class="data_auto">(*)</span></label>
                                                <select id="input_sim_waves" class="select<?php if($id == 2 || $id == 3) echo '-2' ?>">
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                            <div <?php if($id==3) echo "style='display:none'" ?> >
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Sim điện thoại<span class="data_auto">(*)</span></label>
                                                <select id="total_sim" class="select<?php if($id == 2 || $id == 3) echo '-2' ?>">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>
                                            <div style="margin-top:10px">
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Sóng wifi <span class="data_auto">(*)</span></label>
                                                <select id="input_wifi" class="select<?php if($id == 2 || $id == 3) echo '-2' ?>">
                                                    <option value="3">Wifi</option>
                                                    <option value="1">LTE</option>
                                                    <option value="2">4G</option>
                                                </select>
                                            </div>                                            
                                            <?php if($id==3) { ?>
                                            <div>
                                                <label class="form-label-2">Màu nền<span class="data_auto">(*)</span></label>
                                                <select id="background_color-mg3" class="select-2">
                                                    <option value="1">Sáng</option>
                                                    <option value="2">Tối</option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                            <div>
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Phần trăm pin <span class="data_auto">(*)</span></label>
                                                <input type="number" class="form-control<?php if($id == 2 || $id == 3) echo '-2' ?>" id="input_battery_level" value="<?php echo rand(15,95) ?>" style="background-color: rgb(196, 205, 209);">
                                            </div>
                                            <div <?php if($id == 3) echo "style='display:none'" ?>>
                                                <label class="form-label<?php if($id==2 || $id == 3) echo "-2" ?>">Ngày hôm nay<span class="data_auto">(*)</span></label>
                                                <input type="text" class="form-control<?php if($id == 2 || $id == 3) echo '-2' ?>" id="input_today" style="background-color: rgb(196, 205, 209);" value="<?php echo date("m/d - m/d") ?>">
                                            </div>
                                            <?php 
                                            switch($id) {
                                                case 1 : ?>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thời gian chi tiết<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_detail_date" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s") ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Tên ngân hàng<span class="data_auto">(*)</span></label>
                                                        <select id="input_bank"class="select">
                                                            <option value="BIDV">Bidv</option>
                                                            <option value="VIETINBANK">Vietinbank</option>
                                                            <option value="AGRIBANK">Agribank</option>
                                                            <option value="MBBANK">MB Bank</option>
                                                            <option value="TECHOMBANK">Techcombank</option>
                                                            <option value="SBC">Sacombank</option>
                                                            <option value="VPBANK">Vp Bank</option>
                                                            <option value="ACB">Acb</option>
                                                            <option value="OCB">Ocb</option>
                                                            <option value="TPBANK">Tp Bank</option>
                                                            <option value="VIB">Vib</option>
                                                            <option value="HDBANK">HD Bank</option>
                                                            <option value="SHBVN">Shinhan Bank</option>
                                                            <option value="DONG">Dong A Bank</option>
                                                            <option value="BAO VIET BANK">Bao Viet Bank</option>
                                                            <option value="SHB">SHB</option>
                                                            <option value="MSB">MSB</option>
                                                            <option value="SEABANK">SeaBank</option>
                                                            <option value="ABBANK">AB Bank</option>
                                                            <option value="EXIMBANK">Eximbank</option>
                                                            <option value="SCB">(SCB) Sai Gon</option>
                                                            <option value="NCB">(NCB) Quoc Dan</option>
                                                            <option value="NAM A BANK">Nam A Bank</option>
                                                            <option value="KIEN LONG BANK">Kien Long Bank</option>
                                                            <option value="PVCOMBANK">PVCOMBANK</option>
                                                            <option value="BAC A BANK">Bac A Bank</option>
                                                            <option value="VIET A BANK">Viet A Bank</option>
                                                            <option value="SGB">SAIGON Bank</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Tổng tiền rút<span class="data_auto"></span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_total_price" required>
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Mã giao dịch<span class="data_auto">(*)</span>(10 số)</label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_trade_code" style="background-color: rgb(196, 205, 209);" value="<?php echo rand(1000000000,9999999999) ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Trạng thái giao dịch<span class="data_auto">(*)</span></label>
                                                        <select id="input_trade_status" class="select">
                                                            <option value=1>Rút tiền thành công</option>
                                                            <option value=2>Đang xử lý</option>
                                                            <option value=3>Rút tiền thất bại</option>
                                                            <option value=4>Kiểm duyệt thành công</option>
                                                        </select>
                                                    </div>
                                                    <?php break; 
                                                ?>
                                                <?php
                                                case 2 : ?>
                                                    <div class="br_game"></div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Tên game 1<span class="data_auto">(*)</span></label>
                                                        <select id="input_name_game_1" class="select-2">
                                                            <option value="Baccarat">Baccarat</option>
                                                            <option value='Long Hổ'>Long Hổ</option>
                                                            <option value='Con Quay'>Con Quay</option>
                                                            <option value='Xúc Xắc'>Xúc Xắc</option>
                                                            <option value='Đầu Bò'>Đầu Bò</option>
                                                            <option value='Đĩa Màu'>Đĩa Màu</option>
                                                            <option value='Jingmi Baccarat'>Jingmi Baccarat</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thời gian cược game 1<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_detail_date_1" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s") ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Số tiền cược game 1<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_percent1" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_price_1" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                        <select id="input_win_1" class="select-2" style="color:green">
                                                            <option value=1 style="color:green">Thắng</option>
                                                            <option value=2 style="color:red">Thua</option>
                                                        </select>
                                                    </div>

                                                    <div class="br_game"></div>

                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Tên game 2<span class="data_auto">(*)</span></label>
                                                        <select id="input_name_game_2" class="select-2">
                                                            <option value="Baccarat">Baccarat</option>
                                                            <option value='Long Hổ'>Long Hổ</option>
                                                            <option value='Con Quay'>Con Quay</option>
                                                            <option value='Xúc Xắc'>Xúc Xắc</option>
                                                            <option value='Đầu Bò'>Đầu Bò</option>
                                                            <option value='Đĩa Màu'>Đĩa Màu</option>
                                                            <option value='Jingmi Baccarat'>Jingmi Baccarat</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thời gian cược game 2<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_detail_date_2" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(40,60)); ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Số tiền cược game 2<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_percent2" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_price_2" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                        <select id="input_win_2" class="select-2" style="color:green">
                                                            <option value=1 style="color:green">Thắng</option>
                                                            <option value=2 style="color:red">Thua</option>
                                                        </select>
                                                    </div>

                                                    <div class="br_game"></div>

                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Tên game 3<span class="data_auto">(*)</span></label>
                                                        <select id="input_name_game_3" class="select-2">
                                                            <option value="Baccarat">Baccarat</option>
                                                            <option value='Long Hổ'>Long Hổ</option>
                                                            <option value='Con Quay'>Con Quay</option>
                                                            <option value='Xúc Xắc'>Xúc Xắc</option>
                                                            <option value='Đầu Bò'>Đầu Bò</option>
                                                            <option value='Đĩa Màu'>Đĩa Màu</option>
                                                            <option value='Jingmi Baccarat'>Jingmi Baccarat</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thời gian cược game 3<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_detail_date_3" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(100,160)); ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Số tiền cược game 3<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_percent3" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                        <input type="text" class="form-control<?php if($id == 2) echo '-2' ?>" id="input_price_3" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label<?php if($id==2) echo "-2" ?>">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                        <select id="input_win_3" class="select-2" style="color:green">
                                                            <option value=1 style="color:green">Thắng</option>
                                                            <option value=2 style="color:red">Thua</option>
                                                        </select>
                                                    </div>
                                                <?php break; 
                                                case 3: ?>
                                                    <div class="br_game"></div>
                                                    <div>
                                                        <label class="form-label-2">Thời gian rút đơn 1<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_detail_date_1" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s") ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label-2">Số tiền rút đơn 1<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_price_1" style="background-color: rgb(196, 205, 209)" value="<?php echo rand(1,50)*100 ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label-2">Trạng thái rút tiền<span class="data_auto">(*)</span></label>
                                                        <select id="input_win_1" class="select-2" style="color:green">
                                                            <option value=1 style="color:green">Thành công</option>
                                                            <option value=2 style="color:red">Thất bại</option>
                                                        </select>
                                                    </div>

                                                    <div class="br_game"></div>
                                                    <div>
                                                        <label class="form-label-2">Thời gian rút đơn 2<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_detail_date_2" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(1800,4800)); ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label-2">Số tiền rút đơn 2<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_price_2" style="background-color: rgb(196, 205, 209)" value="<?php echo rand(1,50)*100 ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label-2">Trạng thái rút tiền<span class="data_auto">(*)</span></label>
                                                        <select id="input_win_2" class="select-2" style="color:green">
                                                            <option value=1 style="color:green">Thành công</option>
                                                            <option value=2 style="color:red">Thất bại</option>
                                                        </select>
                                                    </div>

                                                    <div class="br_game"></div>
                                                    <div>
                                                        <label class="form-label-2">Thời gian rút đơn 3<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_detail_date_3" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(5400,10800)); ?>">
                                                    </div>
                                                    <div>
                                                        <label class="form-label-2">Số tiền rút đơn 3<span class="data_auto">(*)</span></label>
                                                        <input type="text" class="form-control-2" id="input_price_3" style="background-color: rgb(196, 205, 209)" value="<?php echo rand(1,50)*100 ?>">
                                                    </div>
                                                <?php break; default: break;
                                            } ?>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="create_bill<?php echo ($id) ?>">Tạo hóa đơn mới</button>
                                        </div>
                                        <div style="color:red; text-align:center">
                                            <i>Những mục đánh dấu (*) là dữ liệu tạo tự động, có thể chỉnh sửa nếu cần thiết</i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div id="convert_photo" class="demo_image-container" bis_skin_checked="1">
                                    <img class="photo_style" src="photo-withdrawal/<?php echo $value['photo_demo'] ?>" alt="Demo bill" />
                                </div>
                            </div>
                        </div>
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
    <script src="index.js"></script>

</body>









</html>