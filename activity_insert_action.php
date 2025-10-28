<?php
session_start();
if($_SESSION['role'] != 'M'){
    die("你沒有權限新增活動");
}

include "db.php";

$name = $_POST['name'];
$date = $_POST['date'];
$fee = $_POST['fee'];

$sql = "INSERT INTO activity (name, date, fee) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $name, $date, $fee);
$stmt->execute();

header("Location: activity.php");
