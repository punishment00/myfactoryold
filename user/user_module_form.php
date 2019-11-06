<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%"></th>
            <th class="text-center">Can Create</th>
            <th class="text-center">Can Read</th>
            <th class="text-center">Can Update</th>
            <th class="text-center">Can Delete</th>
            <th class="text-center">Can Approve</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $menu_res = $user_class->getMenu(); 
        while($row = $menu_res->fetch(PDO::FETCH_ASSOC)) 
        {
            $mn_id = $row["mn_id"]; 
            $menu_desc = $row["description"]; 


            //===== get the permission list if not new user =====//
            if(!$is_new_user)
            {
                $pms_res = $user_class->getUserPermissionByMenu($usr_id, $mn_id); 
                $pms_row = $pms_res->fetch(PDO::FETCH_ASSOC); 

                $can_create = $pms_row["can_create"]; 
                $can_read = $pms_row["can_read"]; 
                $can_update = $pms_row["can_update"]; 
                $can_delete = $pms_row["can_delete"]; 
                $can_approve = $pms_row["can_approve"]; 

                $chk_create = ($can_create==1) ? "checked" : ""; 
                $chk_read = ($can_read==1) ? "checked" : ""; 
                $chk_update = ($can_update==1) ? "checked" : ""; 
                $chk_delete = ($can_delete==1) ? "checked" : ""; 
                $chk_approve = ($can_approve==1) ? "checked" : ""; 
            }
            else
            {
                $chk_create = ""; 
                $chk_read = ""; 
                $chk_update = ""; 
                $chk_delete = ""; 
                $chk_approve = ""; 
            }


        ?>
            <tr>
                <td class="align-middle"><input type="checkbox" onchange="checkAllBox($(this))" /> <?= $menu_desc; ?></td>
                <td class="align-middle" align="center"><input type="checkbox" name="permission[<?= $mn_id; ?>][]" value="can_create" <?= $chk_create ?> /></td>
                <td class="align-middle" align="center"><input type="checkbox" name="permission[<?= $mn_id; ?>][]" value="can_read" <?= $chk_read ?> /></td>
                <td class="align-middle" align="center"><input type="checkbox" name="permission[<?= $mn_id; ?>][]" value="can_update" <?= $chk_update ?> /></td>
                <td class="align-middle" align="center"><input type="checkbox" name="permission[<?= $mn_id; ?>][]" value="can_delete" <?= $chk_delete ?> /></td>
                <td class="align-middle" align="center"><input type="checkbox" name="permission[<?= $mn_id; ?>][]" value="can_approve" <?= $chk_approve ?> /></td>
            </tr>
        <?php
        }//===== end while =====//

        ?>
    </tbody>
</table>

<script type="text/javascript">
    function checkAllBox(this_chk) 
    {
        var chk_val = this_chk.prop("checked"); 
        this_chk.parent("td").siblings("td").find("input[type='checkbox']").prop("checked", chk_val); 
    }
</script>