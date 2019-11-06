<?php 
include "../lock.php"; 

// echo "<pre>";
// print_r($_POST); 
// echo "</pre>";

$usr_id=$_POST["usr_id"]; 
$is_new_user = $_POST["is_new_user"]; 
$usr_password = $_POST["usr_password"];  

$arr_info = array(); 
$arr_info["username"] = $username = $_POST["username"]; 
$arr_info["usr_password"] = password_hash($usr_password, PASSWORD_DEFAULT); 
$arr_info["full_name"] = $full_name = $_POST["full_name"]; 
$arr_info["position"] = $position = $_POST["position"]; 
$arr_info["language"] = $language = $_POST["language"]; 
$arr_info["created_by"] = $acctid; 
$arr_info["updated_by"] = $acctid; 

$arr_permission = $_POST["permission"]; 


try
{
    $db->conn->beginTransaction(); 

    
    if($is_new_user)
    {
        // insert user query
        $usr_id = $user_class->createNewUser($arr_info); 
    }
    else
    {
        unset($arr_info["username"]); 
        unset($arr_info["created_by"]); 
        if($usr_password=="")
        {
            unset($arr_info["usr_password"]); 
        }
        $user_class->updateUser($usr_id, $arr_info); 
    }

    foreach ($arr_permission as $mn_id => $action) {
        $permission_info["mn_id"] = $mn_id; 
        $permission_info["usr_id"] = $usr_id; 

        if($is_new_user)
        {
            // insert permission
            $user_class->createPermission($permission_info, $action); 
        }
        else
        {
            $user_class->updatePermission($permission_info, $action); 
        }
        
    }


    $db->conn->commit(); 

    header("Location: user_view.php?usr_id=$usr_id"); 
}
catch(PDOException $e) {
    $db->conn->rollBack(); 
    echo $e->getMessage();
}

$db->closeConn();
?>