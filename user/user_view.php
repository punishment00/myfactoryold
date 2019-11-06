<?php 
include "../lock.php";


if(isset($_GET["usr_id"]))
{
    $usr_id = $_GET["usr_id"]; 
    if($user_class->checkUserId($usr_id))
    {
        $is_new_user = false;
    }
    else
        $is_new_user = true; 
}
else
{
    $usr_id=0;
    $is_new_user = true; 
}



// assign page title
$page_title = "User setup"; 
// include page header
include "../include/header.php";
include "../include/sidebar.php";
?>
<div class="col-10 offset-2 content-box">
    <h3><?= ($is_new_user) ? $hdlang["create_new_user"] : $hdlang["User Account"]; ?></h3>
    <div class="d-flex mb-2">
        <a class="btn btn-sm btn-danger mr-2" href="index.php">Back</a>
        <button class="btn btn-success btn-sm mr-2" type="button" onclick="formSubmit()">Save</button>
    </div>
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

            <form id="form_create" method="POST" action="user_saving.php">
                <input type="hidden" name="usr_id" value="<?= $usr_id; ?>">
                <input type="hidden" name="is_new_user" value="<?= ($is_new_user) ? 1 : 0; ?>">

                <div class="tab-content pt-3">
                    <div class="tab-pane active" id="user_profile">
                        <?php include "user_profile_form.php"; ?>
                    </div>
                    <div class="tab-pane fade" id="user_module">
                        <?php include "user_module_form.php"; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function formSubmit()
    {
        $("#form_create").submit(); 
    }
</script>

<?php 
// include page footer
include "../include/footer.php"; 

// db close conn 
$db->closeConn(); 
?>