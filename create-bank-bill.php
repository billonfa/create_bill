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
    <title><?php echo $value['name'] ?></title>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_white"></div>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_white"></div>
                    <div class="total_price_number-agribank"><span id="output_total_price-agribank">1.000.000.000</span> VND</div>
                    <div id="output_recipient_number-agribank" class="recipient_number-agribank">123456789</div>
                    <div id="output_recipient_name-agribank" class="recipient_name-agribank">NGUYEN TINH</div>
                    <div id="output_trade_code-agribank" class="trade_code-agribank">106706</div>
                    <div id="output_recipient_bank-agribank" class="recipient_bank-agribank">Vietcombank</div>
                    <div id="output_trade_time-agribank" class="trade_time">12:29 08/12/2023</div>
                <?php break;}
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
                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_black"></div>
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
                //------------------------- Dữ liệu của MB Bank -------------------------
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_white"></div>
                    <div class="recipient_name-momo">
                        CHUYỂN TIỀN ĐẾN 
                        <span id="output_recipient_name-momo">NGUYEN TINH TINH</span>
                        <span>(<span id="output_recipient_bank-momo">ACB</span>)</span>
                    </div>
                    <div class="total_price-momo"><span class="subtraction">-<span id="output_total_price-momo">50.000.000</span><span>đ</span></div>
                    <div id="output_time-momo" class="time-momo">21:29 - 19/02/2023</div>
                    <div id="output_trade_code-momo" class="trade_code-momo">35637957291</div>
                    <div id="output_transfer_bank-momo" class="transfer_bank-momo">Ví MoMo</div>
                    <div class="overheads-momo"><span id="output_overheads-momo">328.300</span>đ</div>
                    <div id="output_recipient_number-momo" class="recipient_number-momo">99999999999</div>
                    <div id="output_banking_name-momo" class="banking_name-momo">NGUYEN TINH</div>
                    <div id="output_banking_bank-momo" class="banking_bank-momo"> NH TMCP A Chau (ACB)</div>
                    <div class="total_price2-momo"><span id="output_total_price2-momo">50.000.000</span><span>VND</span></div>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg"/></span>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_black.jpg"/></span>
                    </div>
                    <div class="block_recipient_name-techcombank">
                        <div>Chuyển thành công</div>
                        <div style="width:369px">tới <span id="output_recipient_name-techcombank" class="recipient_name-techcombank">NGUYEN TINH</span></div>
                        <div>VND</div>
                        <div id="output_total_price-techcombank" class="total_price-techcombank">99,999,999,999</div>
                    </div>
                    <div id="output_battery_level" class="battery-level background_black"></div>
                    <div id="output_recipient_bank-techcombank" class="recipient_bank-techcombank">Ngân hàng TMCP Ngoại thương Việt Nam</div>
                    <div id="output_recipient_number-techcombank" class="recipient_number-techcombank">8989 8989 898</div>
                    <div id="output_message-techcombank" class="message-techcombank">Demo bill Techcombank</div>
                    <div id="output_time-techcombank" class="time-techcombank">18 tháng 3, 2023</div>
                    <div class="trade_code-techcombank">FT<span id="output_trade_code-techcombank">22288197735763</span></div>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_white"></div>
                    <div class="total_price-vietcombank"><span id="output_total_price-vietcombank">999,999,999</span> VND</div>
                    <div id="output_time-vietcombank" class="time-vietcombank">15:00 Thứ Ba 25/10/2022</div>
                    <div id="output_recipient_name-vietcombank" class="recipient_name-vietcombank">NGUYEN HO TUAN TINH</div>
                    <div id="output_recipient_number-vietcombank" class="recipient_number-vietcombank">9999999999999</div>
                    <div id="output_recipient_bank_name-vietcombank" class="recipient_bank_name-vietcombank">Ngân hàng Quân Đội</div>
                    <div class="recipient_bank_code-vietcombank">(<span id="output_recipient_bank_code-vietcombank">MB</span>)</div>
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
                        <span><img class="img_wifi" src="photo/icon_wifi_white.jpg"/></span>
                    </div>
                    <div id="output_battery_level" class="battery-level background_white"></div>
                    <div id="output_time-vietinbank" class="time-vietinbank">27/01/2023 17:20</div>
                    <div id="output_trade_code-vietinbank" class="trade_code-vietinbank">932S22A1KEPNM5K7</div>
                    <div id="output_from_number-vietinbank" class="from_number-vietinbank">9999</div>
                    <div id="output_from_name-vietinbank" class="from_name-vietinbank">NGUYEN TINH</div>
                    <div id="output_recipient_number-vietinbank" class="recipient_number-vietinbank">999999999</div>
                    <div id="output_recipient_name-vietinbank" class="recipient_name-vietinbank">NGUYEN TINH</div>
                    <div id="output_recipient_bank-vietinbank" class="recipient_bank-vietinbank">Ngân hàng Ngoại thương Việt Nam (VCB)</div>
                    <div class="recipient_total_number-vietinbank"><span id="output_total_number-vietinbank">1,000,000,000</span> VND</div>
                    <div id="output_total_text-vietinbank" class="recipient_total_text-vietinbank">Một Tỷ Đồng</div>
                    <div class="text_free-vietinbank">Miễn phí</div>
                    <div id="output_message-vietinbank" class="message-vietinbank">demo bill vietinbank</div>
                <?php break;
                }
                //------------------------- Dữ liệu của VpBank -------------------------
                case 12: { 
                    break;
                }

                default: die();} ?>
        </div>
        <button class="button_to_img_acb btn btn-warning w-100" id="create_to_img-<?php echo $id ?>">Xuất ảnh hóa đơn</button>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card" style="margin-top:10px">
            <div class="card-body p-4" style="margin:0; padding:0 !important">
                <div class="p-2 mt-4">
                <div>
                    <label class="form-label">Số vạch sóng điện thoại</label>
                    <select id="input_sim_waves">
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div style="margin-top:10px">
                    <label class="form-label">Sóng wifi</label>
                    <select id="input_wifi">
                        <option value="1">LTE</option>
                        <option value="2">4G</option>
                        <option value="3">Wifi</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Phần trăm pin</label>
                    <input type="number" class="form-control" id="input_battery_level" placeholder="60">
                </div>
    <?php if($id == 1) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-acb" placeholder="20:40">
                </div>
            
                <div>
                    <label class="form-label">Số tiền chuyển (số)</label>
                    <input type="" class="form-control" id="input_total_number-acb" placeholder="1.000.000.000 VND">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển (chữ)</label>
                    <input type="text" class="form-control" id="input_total_text-acb" placeholder="Một tỷ đồng">
                </div>
                <div>
                    <label class="form-label">Ngày lập lệnh</label>
                    <input type="text" class="form-control" id="input_time-acb" placeholder="11/10/2022 - 20:40:00">
                </div>
                <div>
                    <label class="form-label">Ngày hiệu lực</label>
                    <input type="text" class="form-control" id="input_day-acb" placeholder="11/10/2022">
                </div>
                <div>
                    <label class="form-label">Bên chuyển (tên)</label>
                    <input type="text" class="form-control" id="input_transferer_name-acb" placeholder="NGUYEN HO TUAN TINH">
                </div>
                <div>
                    <label class="form-label">Bên chuyển (số)</label>
                    <input type="number" class="form-control" id="input_transferer_number-acb" placeholder="999999">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-acb" placeholder="NGUYEN HO TUAN TINH">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-acb" placeholder="ACB - NH TMCP A CHAU">
                </div>
                <div>
                    <label class="form-label">Tài khoản nhận</label>
                    <input type="number" class="form-control" id="input_recipient_number-acb" placeholder="8888888888">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-acb">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 2) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-agribank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển</label>
                    <input type="" class="form-control" id="input_total_price-agribank" placeholder="1.000.000.000 VND">
                </div>
                <div>
                    <label class="form-label">Số thẻ/ Số TK thụ hưởng</label>
                    <input type="number" class="form-control" id="input_recipient_number-agribank" placeholder="1234456789">
                </div>
                <div>
                    <label class="form-label">Tên người thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_name-agribank" placeholder="NGUYEN TINH">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (6 số)</label>
                    <input type="number" class="form-control" id="input_trade_code-agribank" placeholder="106706">
                </div>
                <div>
                    <label class="form-label">Ngân hàng thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_bank-agribank" placeholder="Vietcombank">
                </div>
                <div>
                    <label class="form-label">Thời gian giao dịch</label>
                    <input type="text" class="form-control" id="input_trade_time-agribank" placeholder="12:29 08/12/2023">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-<?php echo $id ?>">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 3) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-bidv" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển</label>
                    <input type="text" class="form-control" id="input_total_price-bidv" placeholder="999,999,999 VND">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_number-bidv" placeholder="688686868686868">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-bidv" placeholder="NGUYEN TRAN VAN TIN">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-bidv" placeholder="NHTMCP Ngoại thương">
                </div>
                <div>
                    <label class="form-label">Thời gian chuyển khoản</label>
                    <input type="text" class="form-control" id="input_time-bidv" placeholder="13/03/2023 13:32:32">
                </div>
                <div>
                    <label class="form-label">Nội dung chuyển khoản</label>
                    <input type="text" class="form-control" id="input_content-bidv" placeholder="3424">
                </div>
                <div>
                    <label class="form-label">Số tham chiếu</label>
                    <input type="text" class="form-control" id="input_code_number-bidv" placeholder="143369">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-bidv">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 4) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-mbbank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển</label>
                    <input type="text" class="form-control" id="input_total_price-mbbank" placeholder="999,999,999 VND">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-mbbank" placeholder="NGUYEN TINH">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người nhận</label>
                    <input type="number" class="form-control" id="input_recipient_number-mbbank" placeholder="999999999999999">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-mbbank" placeholder="Ngoại thương Việt Nam (Vietcombank, VCB)">
                </div>
                <div>
                    <label class="form-label">Tài khoản nguồn</label>
                    <input type="number" class="form-control" id="input_source_account-mbbank" placeholder="8888888888888">
                </div>
                <div>
                    <label class="form-label">Tên tài khoản nguồn</label>
                    <input type="text" class="form-control" id="input_source_name-mbbank" placeholder="NGUYEN TINH NGUYEN">
                </div>
                <div>
                    <label class="form-label">Nội dung chuyển khoản</label>
                    <input type="text" class="form-control" id="input_content-mbbank" placeholder="3424">
                </div>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_time-mbbank" placeholder="18:29:16, 07/01/2023">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (FT và 14 số)</label>
                    <input type="text" class="form-control" id="input_code_number-mbbank" placeholder="FT22358547622890">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-mbbank">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 5) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-momo" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-momo" placeholder="NGUYEN TINH TINH">
                </div>
                <div>
                    <label class="form-label">Tên viết tắt ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-momo" placeholder="ACB">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển</label>
                    <input type="number" class="form-control" id="input_total_price-momo" placeholder="50.000.000">
                </div>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_time-momo" placeholder="21:29 - 19/02/2023">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (11 số)</label>
                    <input type="number" class="form-control" id="input_trade_code-momo" placeholder="35637957291">
                </div>
                <div>
                    <label class="form-label">Tổng phí</label>
                    <input type="number" class="form-control" id="input_overheads-momo" placeholder="328.300">
                </div>
                <div>
                    <label class="form-label">Số tài khoản nhận</label>
                    <input type="text" class="form-control" id="input_recipient_number-momo" placeholder="9999999999999">
                </div>
                <div>
                    <label class="form-label">Tên chủ thẻ/ người nhận</label>
                    <input type="text" class="form-control" id="input_banking_name-momo" placeholder="NGUYEN TINH">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_banking_bank-momo" placeholder="NH TMCP A Chau (ACB)">
                </div>
                <div>
                    <label class="form-label">Lời nhắn</label>
                    <input type="text" class="form-control" id="input_message-momo" placeholder="3424">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-momo">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 6) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-msb" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Tên người chuyển</label>
                    <input type="text" class="form-control" id="input_holder_name-msb" placeholder="Nguyen Tinh">
                </div>
                <div>
                    <label class="form-label">Số tiền</label>
                    <input type="number" class="form-control" id="input_total_price-msb" placeholder="1,000,000,000">
                </div>
                <div>
                    <label class="form-label">Số tài khoản thụ hưởng</label>
                    <input type="number" class="form-control" id="input_recipient_number-msb" placeholder="999999999">
                </div>
                <div>
                    <label class="form-label">Tên người thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_name-msb" placeholder="NGUYEN HO TUAN TINH">
                </div>
                    <div>
                    <label class="form-label">Nội dung chuyển khoản</label>
                    <input type="text" class="form-control" id="input_message-msb" placeholder="Demo Bill MSB">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-msb">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 7) { ?>
                <div>
                    <label class="form-label">Đồng hồ</label>
                    <input type="text" class="form-control" id="input_clock-sacombank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người nhận</label>
                    <input type="number" class="form-control" id="input_recipient_number-sacombank" placeholder="400041000348615">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-sacombank" placeholder="NGUYEN HO TUAN TINH">
                </div>
                <div>
                    <label class="form-label">Số tiền chuyển</label>
                    <input type="text" class="form-control" id="input_total_price-sacombank" placeholder="1,000,000,000">
                </div>
                <div>
                    <label class="form-label">Thời gian chuyển tiền</label>
                    <input type="text" class="form-control" id="input_time-sacombank" placeholder="14:09:47 08/02/2023">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (10 số)</label>
                    <input type="number" class="form-control" id="input_trade_code-sacombank" placeholder="3872493694">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người chuyển (12 số)</label>
                    <input type="number" class="form-control" id="input_from_number-sacombank" placeholder="400041000348">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-sacombank" placeholder="Vietcombank">
                </div>
                <div>
                    <label class="form-label">Diễn giải</label>
                    <input type="text" class="form-control" id="input_message-sacombank" placeholder="demo bill Sacombank">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-sacombank">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 8) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-techcombank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Tên người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-techcombank" placeholder="Nguyen Tinh">
                </div>
                <div>
                    <label class="form-label">Số tiền</label>
                    <input type="text" class="form-control" id="input_total_price-techcombank" placeholder="99,999,999,999">
                </div>
                <div>
                    <label class="form-label">Tên ngân hàng thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_bank-techcombank" placeholder="Ngân hàng TMCP Ngoại thương Việt Nam">
                </div>
                <div>
                    <label class="form-label">Số tài khoản ngân hàng thụ hưởng</label>
                    <input type="number" class="form-control" id="input_recipient_number-techcombank" placeholder="8989 8989 898">
                </div>
                <div>
                    <label class="form-label">Lời nhắn</label>
                    <input type="text" class="form-control" id="input_message-techcombank" placeholder="Demo bill Techcombank">
                </div>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_time-techcombank" placeholder="18 tháng 3, 2023">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (14 số)</label>
                    <input type="number" class="form-control" id="input_trade_code-techcombank" placeholder="22288197735763" maxlength="14">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-techcombank">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 10) { ?>
                <div>
                    <label class="form-label">Thời gian</label>
                    <input type="text" class="form-control" id="input_clock-vietcombank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Số tiền </label>
                    <input type="text" class="form-control" id="input_total_price-vietcombank" placeholder="999,999,999">
                </div>
                <div>
                    <label class="form-label">Tên người thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_name-vietcombank" placeholder="NGUYEN HO TUAN TINH">
                </div>
                <div>
                    <label class="form-label">Số tài khoản ngân hàng thụ hưởng</label>
                    <input type="number" class="form-control" id="input_recipient_number-vietcombank" placeholder="9999999999999">
                </div>
                <div>
                    <label class="form-label">Tên ngân hàng thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_bank_name-vietcombank" placeholder="Ngân hàng Quân Đội">
                </div>
                <div>
                    <label class="form-label">Mã ngân hàng thụ hưởng</label>
                    <input type="text" class="form-control" id="input_recipient_bank_code-vietcombank" placeholder="MB">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (10 số)</label>
                    <input type="number" class="form-control" id="input_trade_code-vietcombank" placeholder="2616042867">
                </div>
                <div>
                    <label class="form-label">Nội dung</label>
                    <input type="text" class="form-control" id="input_message-vietcombank" placeholder="demo bill">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-vietcombank">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>

    <?php if($id == 11) { ?>
                <div>
                    <label class="form-label">Giờ hiển thị (20:40)</label>
                    <input type="text" class="form-control" id="input_clock-vietinbank" placeholder="20:40">
                </div>
                <div>
                    <label class="form-label">Thời gian chuyển tiền (27/01/2023 17:20)</label>
                    <input type="text" class="form-control" id="input_time-vietinbank" placeholder="27/01/2023 17:20">
                </div>
                <div>
                    <label class="form-label">Mã giao dịch (932S22A1KEPNM5K7)</label>
                    <input type="text" class="form-control" id="input_trade_code-vietinbank" placeholder="932S22A1KEPNM5K7">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người chuyển (4 số)</label>
                    <input type="number" class="form-control" id="input_from_number-vietinbank" placeholder="9999">
                </div>
                <div>
                    <label class="form-label">Tên người chuyển</label>
                    <input type="text" class="form-control" id="input_from_name-vietinbank" placeholder="NGUYEN TINH">
                </div>
                <div>
                    <label class="form-label">Số tài khoản người nhận</label>
                    <input type="number" class="form-control" id="input_recipient_number-vietinbank" placeholder="999999999">
                </div>
                <div>
                    <label class="form-label">Tên tài khoản người nhận</label>
                    <input type="text" class="form-control" id="input_recipient_name-vietinbank" placeholder="NGUYEN TINH">
                </div>
                <div>
                    <label class="form-label">Ngân hàng nhận</label>
                    <input type="text" class="form-control" id="input_recipient_bank-vietinbank" placeholder="Ngân hàng Ngoại thương Việt Nam (VCB)">
                </div>
                <div>
                    <label class="form-label">Số tiền (số)</label>
                    <input type="text" class="form-control" id="input_total_number-vietinbank" placeholder="1,000,000,000">
                </div>
                <div>
                    <label class="form-label">Số tiền (chữ)</label>
                    <input type="text" class="form-control" id="input_total_text-vietinbank" placeholder="Một Tỷ Đồng">
                </div>
                <div>
                    <label class="form-label">Nội dung</label>
                    <input type="text" class="form-control" id="input_message-vietinbank" placeholder="demo bill vietinbank">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success w-100" id="create_bill-vietinbank">Tạo hóa đơn mới</button>
                </div>
    <?php } ?>
                </div>
            </div>
        </div>
    </div>
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