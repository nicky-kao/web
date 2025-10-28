<?php include('header.php'); ?>
<?php
if (!isset($_SESSION['account'])) {
    echo "<div class='container my-5'><div class='alert alert-danger'>請先登入才能報名！</div></div>";
    exit;
}

$name = $_SESSION['name'];
$role = $_SESSION['role'];
$free = $_SESSION['free'] ?? false;
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm p-4">

        <form method="post" action="">
          <label class="form-label">晚餐選擇:</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="dinner" id="no_dinner" value="0" checked>
            <label class="form-check-label" for="no_dinner">不訂晚餐</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="dinner" id="yes_dinner" value="60">
            <label class="form-check-label" for="yes_dinner">訂晚餐 (60元)</label>
          </div>

          <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">送出</button>
        </form>

<?php
if (isset($_POST['submit'])) {
    $dinner = isset($_POST['dinner']) ? (int)$_POST['dinner'] : 0;

    $fee = 0;
    if (!$free && !in_array($role, ['M', 'T'])) {
        $fee = $dinner;
    }

    echo "<h5 class='mt-3'>報名資訊：</h5>";


    if ($role === 'M') {
        $identity = "管理員";
    } elseif ($role === 'T') {
        $identity = "老師";
    } elseif ($role === 'teacher') {
        $identity = "教職員";
    } else {
        $identity = "學生";
    }

    echo "身份: " . $identity . "<br/>";
    echo "晚餐: " . ($dinner ? "訂晚餐 ($dinner 元)" : "不訂晚餐") . "<br/>";
    echo "總費用: <strong>$fee 元</strong>";
}
?>

      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
