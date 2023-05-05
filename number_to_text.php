<?php
function numberToWords($number) {
    $words = array(
        0 => 'không',
        1 => 'một',
        2 => 'hai',
        3 => 'ba',
        4 => 'bốn',
        5 => 'năm',
        6 => 'sáu',
        7 => 'bảy',
        8 => 'tám',
        9 => 'chín',
        10 => 'mười',
        11 => 'mười một',
        12 => 'mười hai',
        13 => 'mười ba',
        14 => 'mười bốn',
        15 => 'mười năm',
        16 => 'mười sáu',
        17 => 'mười bảy',
        18 => 'mười tám',
        19 => 'mười chín',
        20 => 'hai mươi',
        30 => 'ba mươi',
        40 => 'bốn mươi',
        50 => 'năm mươi',
        60 => 'sáu mươi',
        70 => 'bảy mươi',
        80 => 'tám mươi',
        90 => 'chín mươi'
    );

    if (!is_numeric($number)) {
        return false;
    }

    // Chuyển đổi các số hàng trăm và hàng nghìn thành chữ
    if (($number >= 0 && $number < 21) || $number == 30 || $number == 40 || $number == 50 || $number == 60 || $number == 70 || $number == 80 || $number == 90) {
        return $words[$number];
    } elseif ($number > 20 && $number < 100) {
        return $words[10 * floor($number / 10)] . ' ' . $words[$number % 10];
    } elseif ($number >= 100 && $number < 1000) {
        return $words[floor($number / 100)] . ' trăm ' . numberToWords($number % 100);
    } elseif ($number >= 1000 && $number < 1000000) {
        return numberToWords(floor($number / 1000)) . ' nghìn ' . numberToWords($number % 1000);
    } elseif ($number >= 1000000 && $number < 1000000000) {
        return numberToWords(floor($number / 1000000)) . ' triệu ' . numberToWords($number % 1000000);
    } else {
        return false;
    }
}
?>