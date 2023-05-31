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
                $sql2 = "SELECT * FROM bet WHERE id = '$id'";
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
    

    <div class="ruler"></div>
    <div class="ruler_doc"></div>
    <div class="ruler_doc2"></div>
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
                        <a class="nav-link menu-link" href="../create-withdrawal/">
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
                    <?php
                        switch ($id) {
                            //------------------------- Dữ liệu đơn cược Bóng -------------------------
                            case 1: { ?>
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-2 mt-4">
                                                        <div>
                                                            <label class="form-label-2">Tên đội bóng thứ nhất</label>
                                                            <input type="text" class="form-control-2" id="input_name_team1" placeholder="Leicester City FC">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Tên đội bóng thứ 2</label>
                                                            <input type="text" class="form-control-2" id="input_name_team2" placeholder="Liverpool FC">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Giải đấu</label>
                                                            <input type="text" class="form-control-2" id="input_name_league" placeholder="Giải Ngoại Hạng Anh">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Nội dung kèo</label>
                                                            <select class="select-2" id="input_match">
                                                                <option value="Tài/Xỉu">Tài/Xỉu</option>
                                                                <option value="Cược Chấp">Cược Chấp</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Nội dung chi tiết kèo</label>
                                                            <input type="text" class="form-control-2" id="input_detail_match" placeholder="Liverpool FC -1">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Thời gian bắt đầu trận</label>
                                                            <input type="text" class="form-control-2" id="input_time_start" value="<?php echo date("Y-m-d 02:00:00") ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <span class="br_ngang">
                                                </span>

                                                <div class="col-md-6">
                                                    <div class="p-2 mt-4">
                                                        <div>
                                                            <label class="form-label-2">Thời gian cược<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_time" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Tỷ lệ ăn Hồng Kông/ Châu Âu<span class="data_auto">(*)</span></label>
                                                            <select class="select-2" id="input_cate">
                                                                <option value="1">Hồng Kông</option>
                                                                <option value="2">Châu Âu</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Tỷ lệ ăn cược<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_percent" style="background-color: rgb(196, 205, 209);" value="<?php echo rand(80,120) / 100 ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Hiệp 1/ Cả trận<span class="data_auto">(*)</span></label>
                                                            <select class="select-2" id="input_half">
                                                                <option value="Hiệp 1">Hiệp 1</option>
                                                                <option value="Cả Trận">Cả trận</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Số tiền cược<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_price" style="background-color: rgb(196, 205, 209);" value="<?php echo rand(1,9)*100 ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Mã giao dịch<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_trade_code" value="<?php echo rand(100000000000000000,999999999999999999) ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4; w-50" style="margin: 0px auto">
                                                    <button class="btn btn-success w-100" id="buttun-create-bet-ball">Tạo hóa đơn mới</button>
                                                </div>
                                                <div style="color:red; text-align:center;">
                                                    <i>Những mục đánh dấu (*) là dữ liệu tạo tự động, có thể chỉnh sửa nếu cần thiết</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php 
                                    $photos = json_decode($value['photo']);
                                    foreach ($photos as $key_photo => $photo) { ?>
                                    <div class="col-md-6 align-self-end">
                                        <div class="card"id="new-bet-ball-<?php echo $key_photo ?>">
                                            <div class="card-body w-100" style="margin:0;">
                                                <img src="photo-bet/<?php echo $photo ?>.png" style="width: 100%; position: relative"/>
                                                <?php
                                                    switch($key_photo) {
                                                        case 0: ?> 
                                                            <div class="bet_price-0"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-0">500</span><span class="end_price-0">.00</span></div>
                                                            <div class="total_win-0"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-0">525</span><span class="end_price-0">.00</span></div>
                                                            <div class="detail_match-0" id="detail_match-0">Liverpool FC -0.5</div>
                                                            <div class="percent-0" id="percent-0">1.05</div>
                                                            <div class="match_info-0"><span id="match-0">Cược Chấp</span><span>-</span><span id="half-0">Hiệp 1</span></div>
                                                            <div class="team_name-0"><span id="name_team1-0">Liverpool FC</span> vs. <span id="name_team2-0">Tottenham Hotspur</span></div>
                                                            <div class="league-0" id="league-0">Giải Ngoại Hạng Anh</div>
                                                            <div class="time_start-0" id="time_start-0">2023-04-30 22:30:00</div>
                                                        <?php break;
                                                        case 1: ?>
                                                            <div class="one_ve">1<span class="ve"> Vé</span></div>
                                                            <div class="bet_price-1"><span class="mr_5px"><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-1">1 ,000</span><span class="end_price-1">.00</span></div>
                                                            <div class="detail_match-1"><span id="detail_match-1">Manchester United FC -0.5</span><span id="a_cong"> @ </span><span class="percent-1">1.02</span></div>
                                                            <div class="cate-1"><span id="match-1">Cược Chấp</span><span> </span><span id="cate-1">Kèo Hồng Kông</span></div>
                                                            <div class="time_start-1">Begin Match <span id="time_start-1">05/08 01:00</span></div>
                                                            <div class="team_name-1"><span id="name_team1-1">West Ham United</span> vs. <span id="name_team2-1">Manchester United FC</span></div>
                                                            <div class="league-1">Giải Ngoại Hạng Anh</div>
                                                            <div class="bet_price2-1"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price2-1">1,000</span><span class="end_price2-1">.00</span></div>
                                                            <div class="total_win-1"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-1">1,020</span><span class="end_price2-1">.00</span></div>
                                                            <div class="trade_code-1"><?php echo 9 . rand(10000000000000000, 99999999999999999) ?></div>
                                                            <div class="time-1">05/07 21:19</div>
                                                        <?php break;
                                                        case 2: ?>
                                                            <div class="one_ve-2">1<span class="ve"> Vé</span></div>
                                                            <div class="bet_price-2"><span class="mr_5px"><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-2">1 ,000</span><span class="end_price-2">.00</span></div>
                                                            <div class="detail_match-2"><span id="detail_match-2">Manchester United FC -0.5</span><span id="a_cong"> @ </span><span class="percent-2">1.02</span></div>
                                                            <div class="cate-2"><span id="match-2">Cược Chấp</span><span> </span><span id="cate-2">Kèo Hồng Kông</span></div>
                                                            <div class="time_start-2">Begin Match <span id="time_start-2">05/08 01:00</span></div>
                                                            <div class="team_name-2"><span id="name_team1-2">West Ham United</span> vs. <span id="name_team2-2">Manchester United FC</span></div>
                                                            <div class="league-2">Giải Ngoại Hạng Anh</div>
                                                            <div class="bet_price2-2"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price2-2">1,000</span><span class="end_price2-2">.00</span></div>
                                                            <div class="total_win-2"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-2">1,020</span><span class="end_price2-2">.00</span></div>
                                                            <div class="trade_code-2"><?php echo 9 . rand(10000000000000000, 99999999999999999) ?></div>
                                                            <div class="time-2">05/07 21:19</div>
                                                        <?php break; 
                                                        case 3: ?>
                                                            <div class="one_ve-3">1<span class="ve-3"> Vé</span></div>
                                                            <div class="bet_price-3"><span class="mr_5px"><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-3">1 ,000</span><span class="end_price-3">.00</span></div>
                                                            <div class="detail_match-3"><span id="detail_match-3">Manchester United FC -0.5</span><span id="a_cong"> @ </span><span class="percent-3">1.02</span></div>
                                                            <div class="cate-3"><span id="match-3">Cược Chấp</span><span> </span><span id="cate-3">Kèo Hồng Kông</span></div>
                                                            <div class="time_start-3">Begin Match <span id="time_start-3">05/08 01:00</span></div>
                                                            <div class="team_name-3"><span id="name_team1-3">West Ham United</span> vs. <span id="name_team2-3">Manchester United FC</span></div>
                                                            <div class="league-3">Giải Ngoại Hạng Anh</div>
                                                            <div class="bet_price2-3"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price2-3">1,000</span><span class="end_price2-3">.00</span></div>
                                                            <div class="total_win-3"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-3">1,020</span><span class="end_price2-3">.00</span></div>
                                                            <div class="trade_code-3"><?php echo 9 . rand(10000000000000000, 99999999999999999) ?></div>
                                                            <div class="time-3">05/07 21:19</div>
                                                        <?php break; 
                                                        case 4: ?>
                                                            <div class="one_ve-4">1<span class="ve"> Vé</span></div>
                                                            <div class="bet_price-4"><span class="mr_5px"><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-4">1 ,000</span><span class="end_price-4">.00</span></div>
                                                            <div class="detail_match-4"><span id="detail_match-4">Manchester United FC -0.5</span><span id="a_cong"> @ </span><span class="percent-4">1.02</span></div>
                                                            <div class="cate-4"><span id="match-4">Cược Chấp</span><span> </span><span id="cate-4">Kèo Hồng Kông</span></div>
                                                            <div class="time_start-4">Begin Match <span id="time_start-4">05/08 01:00</span></div>
                                                            <div class="team_name-4"><span id="name_team1-4">West Ham United</span> vs. <span id="name_team2-4">Manchester United FC</span></div>
                                                            <div class="league-4">Giải Ngoại Hạng Anh</div>
                                                            <div class="bet_price2-4"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price2-4">1,000</span><span class="end_price2-4">.00</span></div>
                                                            <div class="total_win-4"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-4">13,650</span><span class="end_price2-4">.00</span></div>
                                                            <div class="trade_code-4"><?php echo 9 . rand(10000000000000000, 99999999999999999) ?></div>
                                                            <div class="time-4">05/07 21:19</div>
                                                        <?php break; 
                                                        case 5: ?>
                                                            <div class="one_ve-5">1<span class="ve"> Vé</span></div>
                                                            <div class="bet_price-5"><span class="mr_5px"><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price-5">1 ,000</span><span class="end_price-5">.00</span></div>
                                                            <div class="detail_match-5"><span id="detail_match-5">Manchester United FC -0.5</span><span id="a_cong"> @ </span><span class="percent-5">1.02</span></div>
                                                            <div class="cate-5"><span id="match-5">Cược Chấp</span><span> </span><span id="cate-5">Kèo Hồng Kông</span></div>
                                                            <div class="time_start-5">Begin Match <span id="time_start-5">05/08 01:00</span></div>
                                                            <div class="team_name-5"><span id="name_team1-5">West Ham United</span> vs. <span id="name_team2-5">Manchester United FC</span></div>
                                                            <div class="league-5">Giải Ngoại Hạng Anh</div>
                                                            <div class="bet_price2-5"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="bet_price2-5">1,000</span><span class="end_price2-5">.00</span></div>
                                                            <div class="total_win-5"><span><img src="photo-bet/icon_money.png" class="img_icon_money"/> </span><span id="total_win-5">13,650</span><span class="end_price2-5">.00</span></div>
                                                            <div class="trade_code-5"><?php echo 9 . rand(10000000000000000, 99999999999999999) ?></div>
                                                            <div class="time-5">05/07 21:19</div>
                                                        <?php break; 
                                                    } ?>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning w-100" id="create_to_img-<?php echo $key_photo ?>">Xuất ảnh hóa
                                            đơn</button>
                                    </div>

                                    <div class="col-md-6 align-self-end" style="display:none">
                                        <div class="card">
                                            <div class="card-body w-100"  >
                                                <img src="photo-bet/photo_demo<?php echo $key_photo + 1 ?>.png" style="width: 100%"/>
                                                <?php
                                                    switch($key_photo) {
                                                        case 0: ?> 
                                                        <?php
                                                    } ?>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <?php 
                                    } ?>
                                </div>
                                <?php break;
                            } ?>
                        
                                <!-- ------------------------- Dữ liệu đơn casino ------------------------- -->
                            <?php
                            case 2: { $rand_icon = rand(1,3); ?>
                                <div class="row">
                                    <div class="container_box" bis_skin_checked="1">
                                        <div class="col-md-6 col-lg-6 col-xl-3" style='width:500px'>
                                            <div class="card" style="margin-top:10px">
                                                <div class="card-body p-4" style="margin:0; padding:0 !important">
                                                    <div class="p-2 mt-4">
                                                        <div>
                                                            <label class="form-label-2">Đồng hồ <span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_clock" value="<?php echo date('H:i') ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Số vạch sóng điện thoại <span class="data_auto">(*)</span></label>
                                                            <select id="input_sim_waves" class="select-2">
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="2">2</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Sim điện thoại<span class="data_auto">(*)</span></label>
                                                            <select id="total_sim" class="select-2">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                            </select>
                                                        </div>
                                                        <div style="margin-top:10px">
                                                            <label class="form-label-2">Sóng wifi <span class="data_auto">(*)</span></label>
                                                            <select id="input_wifi" class="select-2">
                                                                <option value="3">Wifi</option>
                                                                <option value="1">LTE</option>
                                                                <option value="2">4G</option>
                                                            </select>
                                                        </div> 
                                                        <div>
                                                            <label class="form-label-2">Phần trăm pin <span class="data_auto">(*)</span></label>
                                                            <input type="number" class="form-control-2" id="input_battery_level" value="<?php echo rand(15,95) ?>" style="background-color: rgb(196, 205, 209);">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Ngày hôm nay<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_today" style="background-color: rgb(196, 205, 209);" value="<?php echo date("m/d - m/d") ?>">
                                                        </div>
                                                        <div class="br_game"></div>
                                                        <div>
                                                            <label class="form-label-2">Tên game 1<span class="data_auto">(*)</span></label>
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
                                                            <label class="form-label-2">Thời gian cược game 1<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_detail_date_1" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s") ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Số tiền cược game 1<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_percent1" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                            <input type="text" class="form-control-2" id="input_price_1" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                            <select id="input_win_1" class="select-2" style="color:green">
                                                                <option value=1 style="color:green">Thắng</option>
                                                                <option value=2 style="color:red">Thua</option>
                                                            </select>
                                                        </div>

                                                        <div class="br_game"></div>

                                                        <div>
                                                            <label class="form-label-2">Tên game 2<span class="data_auto">(*)</span></label>
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
                                                            <label class="form-label-2">Thời gian cược game 2<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_detail_date_2" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(40,60)); ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Số tiền cược game 2<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_percent2" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                            <input type="text" class="form-control-2" id="input_price_2" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                            <select id="input_win_2" class="select-2" style="color:green">
                                                                <option value=1 style="color:green">Thắng</option>
                                                                <option value=2 style="color:red">Thua</option>
                                                            </select>
                                                        </div>

                                                        <div class="br_game"></div>

                                                        <div>
                                                            <label class="form-label-2">Tên game 3<span class="data_auto">(*)</span></label>
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
                                                            <label class="form-label-2">Thời gian cược game 3<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_detail_date_3" style="background-color: rgb(196, 205, 209);" value="<?php echo date("Y-m-d H:i:s", time() - rand(100,160)); ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Số tiền cược game 3<span class="data_auto">(*)</span></label>
                                                            <input type="text" class="form-control-2" id="input_percent3" style="background-color: rgb(196, 205, 209); width: 15%" value="<?php echo rand(85,100) . "%" ?>">
                                                            <input type="text" class="form-control-2" id="input_price_3" style="background-color: rgb(196, 205, 209); width: 40%" value="<?php echo rand(1,9)*100 ?>">
                                                        </div>
                                                        <div>
                                                            <label class="form-label-2">Thắng/ Thua<span class="data_auto">(*)</span></label>
                                                            <select id="input_win_3" class="select-2" style="color:green">
                                                                <option value=1 style="color:green">Thắng</option>
                                                                <option value=2 style="color:red">Thua</option>
                                                            </select>
                                                        </div>
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
                                            <div class="create-image-container" id="new_bill<?php echo $id ?>">
                                                <img class="photo_style" src="photo-bet/<?php echo $value['photo'] ?>" alt="Demo bill" />
                                                <div id="output_clock" class="time-bet1">20:40</div>
                                                <span <?php echo ($rand_icon == 3) ? "style=display:none" : '' ?> id="custom-icon" class="custom-icon2"><img style="width:100%" src='../photo/<?php echo ($rand_icon == 1) ? 'location_black.png' : 'clock_black.png' ?>' /></span>
                                                
                                                <div id="output_signal_invi" class="signal">
                                                    <div class="bar background_invi"></div>
                                                    <div class="bar background_invi"></div>
                                                    <div class="bar background_invi"></div>
                                                    <div class="bar background_invi"></div>
                                                </div>
                                                <div id="output_signal" class="signal" >
                                                    <div class="bar background_black"></div>
                                                    <div class="bar background_black"></div>
                                                    <div class="bar background_black"></div>
                                                    <div class="bar background_black"></div>
                                                </div>
                                                <div id="output_signal-1" class="signal-1" style="display:none">
                                                    <div class="bar-1 background_black"></div>
                                                    <div class="bar-1 background_black"></div>
                                                    <div class="bar-1 background_black"></div>
                                                    <div class="bar-1 background_black"></div>
                                                </div>
                                                <div id="output_signal2" class="signal2" style="display:none">
                                                    <div class="bar2 background_black"></div>
                                                    <div class="bar2 background_black"></div>
                                                    <div class="bar2 background_black"></div>
                                                    <div class="bar2 background_black"></div>
                                                </div>
                                                <div id="output_wifi" class="wifi">
                                                    <span><img class="img_wifi" src="../photo/icon_wifi_black.jpg" /></span>
                                                </div>
                                                <div id="output_battery_level" class="background_black battery-level<?php if($id == 2) echo "-3"; if($id == 3) echo '-mg' ?> "></div>

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
                                            </div>
                                            <button class="button_to_img_acb btn btn-warning w-100" style="margin-top:10px" id="create_to_img-<?php echo $id ?>">Xuất ảnh đơn cược</button>
                                        </div>
                                    </div>
                                </div>
                                <?php break;
                            } ?>
                            <?php default: break;
                            } ?>
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