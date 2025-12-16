<?php
/**
 * File kết nối CSDL
 * Mã đề: 14
 * MSSV: 110122028
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gianhanghandmade";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Thiết lập charset UTF-8
$conn->set_charset("utf8");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
