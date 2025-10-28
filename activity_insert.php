<?php
session_start();
if($_SESSION['role'] != 'M'){
    die("你沒有權限新增活動");
}
?>
<form action="activity_insert_action.php" method="post">
  活動名稱: <input type="text" name="name"><br>
  日期: <input type="date" name="date"><br>
  費用: <input type="number" name="fee"><br>
  <input type="submit" value="新增活動">
</form>
