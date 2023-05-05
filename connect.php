<?php
    // Thông tin kết nối tới cơ sở dữ liệu
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "create_bill";
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Tạo kết nối tới cơ sở dữ liệu
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    // Kiểm tra kết nối
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>