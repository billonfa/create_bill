<?php
    session_start(); // Bắt đầu session

    // Xóa tất cả các biến session
    session_unset();
    
    // Xóa session hiện tại
    session_destroy();
    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
    header("Location: login.php"); // Thay đổi login.php thành trang đăng nhập hoặc trang chính của bạn
    exit();
?>