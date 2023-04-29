<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        include_once 'connect.php';
         // Câu truy vấn SQL để lấy dữ liệu
        $sql = "SELECT * FROM bank WHERE id = '$id'";

        // Thực hiện câu truy vấn và lấy kết quả
        $result = $conn->query($sql);

        // Kiểm tra kết quả trả về
        if ($result->num_rows > 0) {
            $data = [];
            // Duyệt qua từng bản ghi và lấy dữ liệu
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "Không có bản ghi nào trong cơ sở dữ liệu";
        }
        // Đóng kết nối tới cơ sở dữ liệu
        $conn->close();
        $value = $data[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- glightbox css -->
    <link rel="stylesheet" href="assets/libs/glightbox/css/glightbox.min.css">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<span class="ruler"></span>
<span class="ruler_doc"></span>
<span class="ruler_doc2"></span>
<div class="container_box" bis_skin_checked="1">
    <div class="box">
        <div class="create-image-container" id="new_bill<?php echo $id ?>">
            <img class="photo_style" src="photo/<?php echo $value['photo'] ?>" alt="Demo bill" />
            <?php 
            switch($id) {
                case 1: { ?>
                    <div id="output_clock-acb" class="time_acb">20:40</div>
                    <div id="output_total_number-acb" class="total_price_number_acb">1.000.000.000 VND</div>
                    <div id="output_total_text-acb" class="total_price_text_acb">Một tỷ đồng</div>
                    <div id="output_time-acb" class="order_time_acb">11/10/2022 - 20:40:00</div>
                    <div id="output_day-acb" class="order_date_acb">11/10/2022</div>
                    <div id="output_transferer_name-acb" class="transferer_name_acb">NGUYEN HO TUAN TINH</div>
                    <div id="output_transferer_number-acb" class="transferer_number_acb">99999</div>
                    <div id="output_recipient_name-acb" class="recipient_name_acb">NGUYEN HO TUAN TINH</div>
                    <div id="output_recipient_bank-acb" class="bank_name_acb">ACB - NH TMCP A CHAU</div>
                    <div id="output_recipient_number-acb" class="recipient_number_acb">8888888</div>
                    <span class="bank_now_acb">Chuyển ngay</span>
                    <?php
                    break; 
                }
                case 2: { ?>
                    <input type="text" class="time-agribank" placeholder="20:40"/>
                    <input type="text" class="total_price_number-agribank" placeholder="1.000.000.000 VND"/>
                    <input type="text" class="recipient_number-agribank" placeholder="123456789"/>
                    <input type="text" class="recipient_name-agribank" placeholder="NGUYEN TINH"/>
                    <input type="text" class="trade_code-agribank" placeholder="106706"/>
                    <input type="text" class="recipient_bank-agribank" placeholder="Vietcombank"/>
                    <input type="text" class="trade_time" placeholder="12:29 08/12/2023"/>
                <?php break;}
                case 3: { ?>
                    <span id="output_clock-bidv" class="time-bidv">20:40</span>
                    <div class="content1">Quý khách đã chuyển thành công số tiền</div>
                    <div class="total_price-bidv">
                        <span id="output_total_price-bidv">999,999,999 VND</span><span> đến số tài khoản</span>
                    </div>
                    <div class="infomation_recipient-bidv">
                        <span class="color_bl" id="output_recipient_number-bidv">68686868686868</span><span class="xoet">/ </span>
                        <span class="color_bl" id="output_recipient_name-bidv">NGUYEN TINH NGUYEN TINH</span><span class="xoet">/ </span>
                        <span class="color_bl" id="output_recipient_bank-bidv"> NHTMCP Ngoại thương</span>
                        <span> vào lúc </span>
                        <span class="xoet" id="output_time-bidv">13/03/2023 13:32:32</span><span>. Nội dung: </span>
                        <span id="output_content-bidv"> 3424</span>
                    </div>
                    <div id="output_code_number-bidv" class="code_number-bidv">143369</div>
                <?php break;}
                case 4: { ?>
                    <span id="output_clock-mbbank" class="time-bidv">20:40</span>
                    <div class="done_bill">Bạn đã chuyển tiền thành công</div>
                    <span class="total_price-mbbank" id="output_total_price-mbbank">999,999,999 VND</span>
                    <div class="recipient_name-mbbank" id="output_recipient_name-mbbank">NGUYEN TINH</div>
                    <div class="recipient_number-mbbank" id="output_recipient_number-mbbank">99999999999999</div>
                    <div class="recipient_bank_icon-mbbank" id="output_recipient_icon-mbbank"></div>
                    <div class="recipient_bank_text-mbbank" id="output_recipient_text-mbbank">Ngoại thương Việt Nam (Vietcombank, VCB)</div>
                    <div class="source_account-mbbank" id="output_source_account-mbbank">8888888888</div>
                    <div class="source_name-mbbank" id="output_source_name-mbbank">NGUYEN TINH NGUYEN</div>
                    <div class="content-mbbank" id="output_content-mbbank">demo bill mbbank</div>
                    <div class="time-mbbank" id="output_time-mbbank">18:29:16, 07/01/2023</div>
                    <div class="hinh_thuc_chuyen-mbbank">Chuyển nhanh Napas</div>
                    <div class="text_247-mbbank">247</div>
                    <div class="trade_code-mbbank" id="output_trade_code-mbbank">FT22358547622890</div>
                <?php break;
                }
                case 5: {
                    break;
                }
                case 6: {
                    break;
                }
                case 7: {
                    break;
                }
                case 8: {
                    break;
                }
                case 9: {
                    break;
                }
                case 10: {
                    break;
                }
                case 11: {
                    break;
                }
                case 12: {
                    break;
                }

                default: die();} ?>
        </div>
        <button class="button_to_img_acb btn btn-warning w-100" id="create_to_img-<?php echo $id ?>">Xuất ảnh hóa đơn</button>
    </div>
    <?php if($id == 1) { ?>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card" style="margin-top:10px">
            <div class="card-body p-4" style="margin:0; padding:0 !important">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Tạo hóa đơn mới</h5>
                </div>
                <div class="p-2 mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Thời gian</label>
                        <input type="text" class="form-control" id="input_clock-acb" placeholder="20:40">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tiền chuyển (số)</label>
                        <input type="" class="form-control" id="input_total_number-acb" placeholder="1.000.000.000 VND">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tiền chuyển (chữ)</label>
                        <input type="text" class="form-control" id="input_total_text-acb" placeholder="Một tỷ đồng">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Ngày lập lệnh</label>
                        <input type="text" class="form-control" id="input_time-acb" placeholder="11/10/2022 - 20:40:00">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Ngày hiệu lực</label>
                        <input type="text" class="form-control" id="input_day-acb" placeholder="11/10/2022">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Bên chuyển (tên)</label>
                        <input type="text" class="form-control" id="input_transferer_name-acb" placeholder="NGUYEN HO TUAN TINH">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Bên chuyển (số)</label>
                        <input type="number" class="form-control" id="input_transferer_number-acb" placeholder="999999">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="input_recipient_name-acb" placeholder="NGUYEN HO TUAN TINH">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Ngân hàng nhận</label>
                        <input type="text" class="form-control" id="input_recipient_bank-acb" placeholder="ACB - NH TMCP A CHAU">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tài khoản nhận</label>
                        <input type="number" class="form-control" id="input_recipient_number-acb" placeholder="8888888888">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" id="create_bill-acb">Tạo hóa đơn mới</button>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
    <?php } ?>

    <?php if($id == 3) { ?>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card mt-4">
            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Tạo hóa đơn mới</h5>
                </div>
                <div class="p-2 mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Thời gian</label>
                        <input type="text" class="form-control" id="input_clock-bidv" placeholder="20:40">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tiền chuyển</label>
                        <input type="text" class="form-control" id="input_total_price-bidv" placeholder="999,999,999 VND">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tài khoản người nhận</label>
                        <input type="text" class="form-control" id="input_recipient_number-bidv" placeholder="688686868686868">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="input_recipient_name-bidv" placeholder="NGUYEN TRAN VAN TIN">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Ngân hàng nhận</label>
                        <input type="text" class="form-control" id="input_recipient_bank-bidv" placeholder="NHTMCP Ngoại thương">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Thời gian chuyển khoản</label>
                        <input type="text" class="form-control" id="input_time-bidv" placeholder="13/03/2023 13:32:32">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nội dung chuyển khoản</label>
                        <input type="text" class="form-control" id="input_content-bidv" placeholder="3424">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tham chiếu</label>
                        <input type="text" class="form-control" id="input_code_number-bidv" placeholder="143369">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" id="create_bill-bidv">Tạo hóa đơn mới</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if($id == 4) { ?>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card mt-4">
            <div class="card-body p-4">
                <div class="p-2 mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Thời gian</label>
                        <input type="text" class="form-control" id="input_clock-mbbank" placeholder="20:40">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tiền chuyển</label>
                        <input type="text" class="form-control" id="input_total_price-mbbank" placeholder="999,999,999 VND">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="input_recipient_name-mbbank" placeholder="NGUYEN TINH">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Số tài khoản người nhận</label>
                        <input type="number" class="form-control" id="input_recipient_number-mbbank" placeholder="999999999999999">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Ngân hàng nhận</label>
                        <input type="text" class="form-control" id="input_recipient_bank-mbbank" placeholder="Ngoại thương Việt Nam (Vietcombank, VCB)">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tài khoản nguồn</label>
                        <input type="number" class="form-control" id="input_source_account-mbbank" placeholder="8888888888888">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên tài khoản nguồn</label>
                        <input type="text" class="form-control" id="input_source_name-mbbank" placeholder="NGUYEN TINH NGUYEN">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nội dung chuyển khoản</label>
                        <input type="text" class="form-control" id="input_content-mbbank" placeholder="3424">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Thời gian</label>
                        <input type="text" class="form-control" id="input_time-mbbank" placeholder="18:29:16, 07/01/2023">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Mã giao dịch (FT và 14 số)</label>
                        <input type="text" class="form-control" id="input_code_number-mbbank" placeholder="FT22358547622890">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" id="create_bill-mbbank">Tạo hóa đơn mới</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="box" >
        <div id="convert_photo" class="demo_image-container" bis_skin_checked="1">
            <img class="photo_style" src="photo/<?php echo $value['phot_demo'] ?>" alt="Demo bill" />
        </div>
    </div>
</div>
</body>
<script src="assets/js/html2canvas.min.js"></script>
<script src="assets/js/FileSaver.min.js"></script>
<script src="assets/js/create-bill.js"></script>
</html>