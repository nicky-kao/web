<?php
require_once "header.php";
try {
    require_once 'db.php';
    $sql = "SELECT * FROM event";   
    $result = mysqli_query($conn, $sql);
?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container my-4">
    <h2 class="mb-3">最新活動</h2>
    <table id="eventTable" class="table table-bordered table-striped display">
        <thead>
            <tr>
                <th>活動名稱</th>
                <th>活動介紹</th>
                <th>報名連結</th>
            </tr>
        </thead>
        
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    
    <div class="d-flex ms-auto">
      <?php if(isset($_SESSION['role']) && $_SESSION['role']=='M'): ?>
        <a href="activity.php" class="btn btn-primary">活動管理</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row["name"] ?></td>
                <td><?= $row["description"] ?></td>
                <td>
                    
                    <?php if($row["name"] == "迎新茶會") { ?>
                        <a href="learning.php" class="btn btn-primary btn-sm">報名去</a>
                    <?php } else { ?>
                        <a href="contact.php" class="btn btn-primary btn-sm">報名去</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#eventTable').DataTable({
        "paging": true,      
        "searching": true,   
        "ordering": true    
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



