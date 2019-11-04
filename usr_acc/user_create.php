<?php 
include "../lock.php";
// assign page title
$page_title = "User setup"; 
// include page header
include "../include/header.php";

include "../include/sidebar.php";
?>
<div class="col-10 offset-2 content-box">
    <h3><?= $hdlang["create_new_user"]; ?></h3>
    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-pills border-bottom pb-2 small">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#user_profile">User Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#user_module">User Module</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="user_profile">
                    123
                </div>
                <div class="tab-pane container fade" id="user_module">
                    123
                </div>
            </div>
        </div>
    </div>

</div>
<?php 
// include page footer
include "../include/footer.php"; 

// db close conn 
$db->closeConn(); 
?>