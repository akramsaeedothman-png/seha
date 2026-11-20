<?php
// إعدادات الاتصال
$host = "localhost";
$user = "root";
$pass = "";
$db   = "seha_a";

// إنشاء الاتصال
$conn = new mysqli($host, $user, $pass, $db);

// فحص الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// ضبط الترميز UTF-8
$conn->set_charset("utf8mb4");
?>
