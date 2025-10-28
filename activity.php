<?php
session_start();
include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'M'){
    die("沒有權限進入此頁面！");
}
  $msg="";
  if ($_POST) {
    
    $company = $_POST["company"];
    $content = $_POST["content"];
    $sql="insert into job (company, content, pdate) values (?, ?, now())";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $company, $content);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      header('location:job.php');
    }
    else {
      $msg = "無法新增資料";
    }
  }

$sql = "SELECT * FROM event";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>活動管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>活動管理</h2>
    <a href="activity_insert.php" class="btn btn-success mb-3">新增活動</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>活動名稱</th>
                <th>日期</th>
                <th>費用</th>
                <?php if($_SESSION['role']=='M') echo "<th>操作</th>"; ?>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['fee']) ?></td>
                <?php if($_SESSION['role']=='M'): ?>
                <td>
                    <a href="activity_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除嗎？')">刪除</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

