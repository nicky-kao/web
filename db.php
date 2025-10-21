<?php
$servername = "localhost";
$dbname = "practice";   
$dbUsername = "root";     
$dbPassword = "";         

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

if (!$conn) {
    die("資料庫連線失敗: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
