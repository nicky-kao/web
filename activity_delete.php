<?php
session_start();
if($_SESSION['role'] != 'M'){
    die("你沒有權限刪除活動");
}

include "db.php";

$id = $_GET['id'];
$sql = "DELETE FROM activity WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: activity.php");
