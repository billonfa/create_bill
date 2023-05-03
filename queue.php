<?php
// Khởi tạo một hàng đợi rỗng
$queue = array();

// Thêm một tác vụ vào hàng đợi
array_push($queue, 'Task 1');

// Thêm các tác vụ khác vào hàng đợi
array_push($queue, 'Task 2', 'Task 3', 'Task 4');

// Lấy tác vụ đầu tiên ra khỏi hàng đợi và xử lý nó
$task = array_shift($queue);
echo 'Đang xử lý tác vụ: ' . $task;

// Hiển thị số lượng tác vụ còn lại trong hàng đợi
echo 'Số lượng tác vụ còn lại trong hàng đợi: ' . count($queue);
?>