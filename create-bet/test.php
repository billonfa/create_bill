<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'ten_cua_database';
$username = 'ten_dang_nhap';
$password = 'mat_khau';

try {
    // Kết nối cơ sở dữ liệu
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Thiết lập chế độ báo lỗi và chế độ truy xuất dữ liệu
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Tìm kiếm ID Telegram trong bảng customer
    $id = 1; // ID Telegram cần tìm kiếm
    $stmt = $pdo->prepare('SELECT * FROM customer WHERE telegram = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $customer = $stmt->fetch();

    // In kết quả
    echo "Thông tin khách hàng có ID $id: ";
} catch (PDOException $e) {
    // Xử lý lỗi nếu có
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
}
?>