<?php include('header.php'); ?>
<?php



$optionsList = [
    '上午場' => 150,
    '下午場' => 100,
    '午餐' => 60,
];


if (!isset($_SESSION['account'])) {
    echo "<div class='alert alert-danger'>請先登入才能報名！</div>";
    exit;
}


$name = $_SESSION['name'];
$role = $_SESSION['role']; 
$free = $_SESSION['free'] ?? false;
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">

          <h4 class="card-title mb-4">報名表</h4>

          <form method="post" action="">
           
          
            <hr/>

            <?php foreach ($optionsList as $key => $price): ?>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="<?= $key ?>" name="options[]" value="<?= $price ?>">
                <label class="form-check-label" for="<?= $key ?>">
                  <?= ucfirst($key) ?> (<?= $price ?> 元)
                </label>
              </div>
            <?php endforeach; ?>

            <button type="submit" name="submit" class="btn btn-primary w-100">送出</button>
          </form>

          <?php
          if (isset($_POST['submit'])) {
              $selectedOptions = $_POST['options'] ?? [];

           
              $total = $free ? 0 : array_sum($selectedOptions);

              echo "<h5 class='mt-3'>報名資訊：</h5>";
              echo "身份: " . ($role === 'teacher' ? '教職員' : '學生') . "<br/>";
              echo "選擇項目: " . (!empty($selectedOptions) ? implode(', ', $selectedOptions) . " 元" : "無") . "<br/>";
              echo "總費用: <strong>$total 元</strong>";
          }
          ?>
          
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

