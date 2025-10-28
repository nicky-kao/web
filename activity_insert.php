<?php
session_start();
include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'M'){
    die("沒有權限進入此頁面！");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $fee = intval($_POST['fee']);

    $stmt = $conn->prepare("INSERT INTO event (name, description, fee) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $name,$description, $fee);
    $stmt->execute();
    $stmt->close();

    header("Location: activity.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新增活動</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>新增活動</h2>
    <form method="post">
        <div class="mb-3">
            <label>活動名稱</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>活動說明</label>
            <input type="description" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>費用</label>
            <input type="number" name="fee" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">新增</button>
        <a href="activity.php" class="btn btn-secondary">返回</a>
    </form>
</div>
</body>
</html>
