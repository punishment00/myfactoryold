<?php 
include "../lock.php";
// assign page title
$page_title = "Order"; 


// include page header
include "../include/header.php";

include "../include/sidebar.php"; 
?>
<style type="text/css">
    iframe#order_page_content
    {
        height: calc(100vh - 100px); 
    }
</style>
<script type="text/javascript">
    var order_ia; 
    var order_anchor=0; 

    function getContent()
    {
        $("#order_page_content").attr("src", getUrl()); 
    }

    function getUrl()
    {
        var str_url;
        switch(order_anchor) 
        {
            case 0: str_url = "/myfactory/master/master.php?ia="+order_ia+"&anchor="+order_anchor; break; 
            case 1: str_url = "/myfactory/plan/plan.php?ia="+order_ia+"&anchor="+order_anchor; break; 
            case 2: str_url = "/myfactory/ticket/ticket.php?ia="+order_ia+"&anchor="+order_anchor; break; 
        }

        return str_url; 
    }

    function setAnchor(anchor_value)
    {
        order_anchor = anchor_value; 
    }

    function setOrder(orderno)
    {
        order_ia = orderno; 
    }
</script>


<div class="col-10 offset-2 content-box">
    <h3>Order</h3>

    <div class="d-flex mb-3">
        <label class="mr-1" for="opt_ia_search">Orderno:</label>
        <select class="form-control-sm w-25 chosen" id="opt_ia_search" name="" onchange="setOrder(this.value); getContent();">
            <option value="" selected disabled>Select IA..</option>
            <?php 
            // get all orderno from tblorder
            $res = $order_class->getAllOrder(); 
            while($row = $res->fetch(PDO::FETCH_ASSOC))
            {
                $orderno = $row["Orderno"]; 

                echo "<option value='$orderno'>$orderno</option>";
            }
            ?>
        </select>
        <button class="btn btn-primary btn-sm mr-1 ml-auto" onclick="setAnchor(0); getContent();">Master</button>
        <button class="btn btn-primary btn-sm mr-1" onclick="setAnchor(1); getContent();">Cut Plan</button>
        <button class="btn btn-primary btn-sm" onclick="setAnchor(2); getContent();">Ticket</button>
    </div>

    <div id="order_page_content_wrapper">
        <iframe class="border w-100" id="order_page_content"></iframe>
    </div>

</div>




<?php 
// include page footer
include "../include/footer.php"; 

// db close conn 
$db->closeConn(); 
?>