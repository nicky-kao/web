<?php
$current = basename($_SERVER['PHP_SELF']);

function nav_active($file){
    global $current;
    return $current === $file ? ' active' : '';
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>活動報名系統</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .navbar-custom {
      background: linear-gradient(90deg, #753535ff, #f7c8c2ff);
    }

    .navbar-custom .nav-link {
      color: white;
      font-weight: 500;
      transition: all 0.3s;
    }

    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
      color: #000;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 5px;
    }
  </style>
  

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom mb-4">
  <div class="container">
    <?php
session_start();
?>
    <a class="navbar-brand text-white" href="#">活動報名系統</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link<?=nav_active('index.php')?>" href="index.php">首頁</a></li>
        <li class="nav-item"><a class="nav-link<?=nav_active('learning.php')?>" href="learning.php">迎新茶會</a></li>
        <li class="nav-item"><a class="nav-link<?=nav_active('contact.php')?>" href="contact.php">一日資管營</a></li>
        <li class="nav-item"><a class="nav-link<?=nav_active('job.php')?>" href="job.php">求職資訊</a></li>
        <?php if (isset($_SESSION['account'])): ?>
  <li class="nav-item">
    <span class="navbar-text text-white me-2">
      <?=htmlspecialchars($_SESSION['name'])?>
    </span>
  </li>
  <li class="nav-item">
    <a class="btn btn-danger" href="logout.php">登出</a>
  </li>
<?php else: ?>
  <li class="nav-item">
    <a class="btn btn-outline-light" href="login.php">登入</a>
  </li>
<?php endif; ?>
        
    
    
    </div>
  </div>
</nav>
