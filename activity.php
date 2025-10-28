<?php
session_start();
include "db.php";

$sql = "SELECT * FROM activity";
$result = $conn->query($sql);
?>
<table>
<tr><th>活動名稱</th><th>日期</th><th>費用</th>
<?php if($_SESSION['role']=='M'){ echo "<th>操作</th>"; } ?>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $row['name'] ?></td>
  <td><?= $row['date'] ?></td>
  <td><?= $row['fee'] ?></td>
  <?php if($_SESSION['role']=='M'): ?>
  <td>
    <a href="activity_delete.php?id=<?= $row['id'] ?>">刪除</a>
  </td>
  <?php endif; ?>
</tr>
<?php endwhile; ?>
</table>
<?php if($_SESSION['role']=='M'): ?>
<a href="activity_insert.php">新增活動</a>
<?php endif; ?>
