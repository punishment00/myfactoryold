<?php 
include "../lock.php";
// assign page title
$page_title = "User maintenance"; 

// include page header
include "../include/header.php";

include "../include/sidebar.php";
?>
<div class="col-10 offset-2 content-box">
   
    <h3>Account Maintenance</h3>
    <div class="mb-2">
        <a href="/myfactory/user/user_view.php" class="btn btn-primary btn-sm"><?= $hdlang["create_new_user"]; ?></a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table datatable table-sm table-bordered small table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Position</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res = $user_class->getAllUser(); 
                    while($row = $res->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $usr_id = $row["usr_id"];
                        $username = $row["username"]; 
                        $full_name = $row["full_name"]; 
                        
                        $position = $row["position"]; 
                        $position_desc = ($position == 1) ? "Admin" : "Normal User"; 
                        
                        $resign_date = $row["resign_date"]; 
                        $resign_style = ($resign_date < $today_date) ? "text-danger" : ""; 
                    ?>
                    <tr class="pointer <?= $resign_style; ?>" onclick="window.location='user_view.php?usr_id=<?= $usr_id; ?>'">
                        <td><?= $username; ?></td>
                        <td><?= $full_name; ?></td>
                        <td><?= $position_desc; ?></td>
                    </tr>
                    <?php 
                    } //===== end while loop =====//
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<?php 
// include page footer
include "../include/footer.php"; 

// db close conn 
$db->closeConn(); 
?>