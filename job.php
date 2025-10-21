<?php
require_once "header.php";
try {
    require_once 'db.php';


    $order = $_POST["order"] ?? "";
    $searchtxt = mysqli_real_escape_string($conn, $_POST["searchtxt"] ?? "");

    $sql = "SELECT * FROM job";


    if ($searchtxt) {
        $sql .= " WHERE (company LIKE '%$searchtxt%' OR content LIKE '%$searchtxt%')";
    }

    $allowed = ['company', 'content', 'pdate'];
    if ($order && in_array($order, $allowed)) {
        $sql .= " ORDER BY $order DESC";
    }

    $result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container my-4">
    <h3 class="mb-3">求才資訊列表</h3>


    <form action="job.php" method="post" class="mb-3 row g-2 align-items-center">
        <div class="col-auto">
            <select name="order" class="form-select">
                <option value="" <?= ($order == '') ? 'selected' : '' ?>>選擇排序欄位</option>
                <option value="company" <?= ($order == 'company') ? 'selected' : '' ?>>求才廠商</option>
                <option value="content" <?= ($order == 'content') ? 'selected' : '' ?>>求才內容</option>
                <option value="pdate" <?= ($order == 'pdate') ? 'selected' : '' ?>>刊登日期</option>
            </select>
        </div>
        <div class="col-auto">
            <input type="text" name="searchtxt" class="form-control" placeholder="搜尋廠商及內容" value="<?= htmlspecialchars($searchtxt) ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">搜尋</button>
        </div>
    </form>

    <table id="jobTable" class="table table-bordered table-striped display">
        <thead>
            <tr>
                <th>求才廠商</th>
                <th>求才內容</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row["company"]) ?></td>
                <td><?= htmlspecialchars($row["content"]) ?></td>
                <td><?= htmlspecialchars($row["pdate"]) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#jobTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": false 
    });
});
</script>

<?php
    mysqli_close($conn);
} catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
require_once "footer.php";
?>
