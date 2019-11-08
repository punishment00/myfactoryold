<?php 
include "../lock.php";
// assign page title
$page_title = "My Factory"; 


// include page header
include "../include/header.php";

include "../include/sidebar.php"; 
?>
<div class="col-10 offset-2 content-box">
    <div class="card mx-auto col-8 p-0 mb-5 mt-3">
        <div class="card-header" data-toggle="collapse" data-target="#cut_menu">
            <h3>Cut</h3>
        </div>
        <div class="card-body collapse p-0" id="cut_menu">
            <div class="card-content-collapse">
                Some content....
            </div>
        </div>
    </div>

    <div class="card mx-auto col-8 p-0 mb-5">
        <div class="card-header" data-toggle="collapse" data-target="#sew_menu">
            <h3>Sew</h3>
        </div>
        <div class="card-body collapse p-0" id="sew_menu">
            <div class="card-content-collapse">
                Some content....
            </div>
        </div>
    </div>

    <div class="card mx-auto col-8 p-0 mb-5">
        <div class="card-header" data-toggle="collapse" data-target="#pack_menu">
            <h3>Pack</h3>
        </div>
        <div class="card-body collapse p-0" id="pack_menu">
            <div class="card-content-collapse">
                Some content....
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