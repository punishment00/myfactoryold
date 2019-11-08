<?php 
class User
{
private $conn; 


public function setConn($conn)
{
    $this->conn = $conn;
}

//====================================== user function =======================================//

public function login($username, $input_password) 
{
	$sql = $this->conn->prepare("SELECT * FROM tbl_user usr WHERE usr.username=:username"); 
	$sql->execute([
		"username" => $username
	]); 

	if($sql->rowCount()>0)
	{
		$row = $sql->fetch(PDO::FETCH_ASSOC); 
		$fetch_password = $row["usr_password"]; 
		$usr_id = $row["usr_id"]; 
        $language = $row["language"]; 
        $username = $row["username"]; 
        
        $resign_date = $row["resign_date"]; 
        $today_date = date("Y-m-d"); 
        if($resign_date<$today_date)
        {
            $_SESSION["login_error"] = 2;
            header("Location: login.php");
            return; 
        }

		if(password_verify($input_password, $fetch_password)) 
		{
			$_SESSION["usr_id"] = $usr_id; 
            $_SESSION["usr_language"] = $language; 
            $_SESSION["username"] = $username; 
			$_SESSION["login_error"] = 0;  

            // log
            $acctid = $usr_id; 
            $mn_id = 0; 
            $desc = "Login"; 

            $query = $this->conn->prepare("INSERT INTO tbl_user_log (usr_id, mn_id, description) VALUES (:usr_id, :mn_id, :description)"); 
            $query->execute([
                "usr_id" => $acctid, 
                "mn_id" => $mn_id, 
                "description" => $desc 
            ]); 

            header("Location: main/main.php"); 
		}
		else
		{
			$_SESSION["login_error"] = 1;
            header("Location: index.php"); 
		}
	}
	else
	{
		$_SESSION["login_error"] = 1;
        header("Location: index.php"); 
	}

}


public function checkIsAdmin() 
{
    $usr_id = $_SESSION["usr_id"]; 

    $sql = $this->conn->prepare("SELECT position FROM tbl_user usr WHERE usr.usr_id=:usr_id");
    $sql->execute([
        "usr_id" => $usr_id 
    ]); 
    $position = $sql->fetchColumn(); 
    if($position == 1)
        return true;
    else 
        return false;
}

public function getAllUser() {
    $res = $this->conn->query("SELECT * FROM tbl_user usr ORDER BY usr.username"); 
    return $res; 
}

public function getSingleUser($usr_id) 
{
    $res = $this->conn->prepare("SELECT * FROM tbl_user usr WHERE usr.usr_id=:usr_id"); 
    $res->execute(["usr_id" => $usr_id]); 
    return $res; 
}


public function createNewUser($arr_info) 
{
    $sql = "INSERT INTO tbl_user (".implode(", ", array_keys($arr_info)).") VALUES (:".implode(", :", array_keys($arr_info)).")"; 
    $query = $this->conn->prepare($sql); 
    $query->execute($arr_info); 

    $usr_id = $this->conn->lastInsertId(); 

    // log
    $acctid = $arr_info["created_by"]; 
    $mn_id = 1; 
    $desc = "Create new user (usr_id: $usr_id)"; 

    $query2 = $this->conn->prepare("INSERT INTO tbl_user_log (usr_id, mn_id, description) VALUES (:usr_id, :mn_id, :description)"); 
    $query2->execute([
        "usr_id" => $acctid, 
        "mn_id" => $mn_id, 
        "description" => $desc 
    ]); 

    return $usr_id;
}


public function updateUser($usr_id, $arr_info) 
{
    $sql = "UPDATE tbl_user SET ";
    foreach ($arr_info as $key => $value) {
        $sql .= "$key = :$key,"; 
    }
    $sql = substr($sql, 0, -1);
    $sql .= " WHERE usr_id = :usr_id"; 
    // echo $sql;
    $query = $this->conn->prepare($sql); 
    $arr_info["usr_id"] = $usr_id; 
    $query->execute($arr_info); 

    // log
    $acctid = $arr_info["updated_by"]; 
    $mn_id = 1; 
    $desc = "Edit user info (usr_id: $usr_id)"; 

    $query2 = $this->conn->prepare("INSERT INTO tbl_user_log (usr_id, mn_id, description) VALUES (:usr_id, :mn_id, :description)"); 
    $query2->execute([
        "usr_id" => $acctid, 
        "mn_id" => $mn_id, 
        "description" => $desc 
    ]); 

}


public function checkUserId($usr_id) 
{
    $sql = $this->conn->prepare("SELECT * FROM tbl_user usr WHERE usr.usr_id=:usr_id"); 
    $sql->execute([
        "usr_id" => $usr_id 
    ]);
    if($sql->rowCount()>0)
        return true;
    else
        return false;
}

//============================== menu and permission function ===============================//

public function createPermission($arr_info, $action) 
{
    $sql = "INSERT INTO tbl_permission (usr_id, mn_id, ".implode(", ", $action).") VALUES (:usr_id, :mn_id, :".implode(", :", $action).")"; 
    $query = $this->conn->prepare($sql); 
    $query->bindParam("usr_id", $arr_info["usr_id"]); 
    $query->bindParam("mn_id", $arr_info["mn_id"]); 
    foreach ($action as $value) {
        $action_value=1;
        $query->bindParam("$value", $action_value); 
    }
    $query->execute(); 
}

public function deletePermission($usr_id) 
{
    $sql = "DELETE FROM tbl_permission WHERE usr_id=:usr_id";
    $query = $this->conn->prepare($sql); 
    $query->bindParam("usr_id", $usr_id); 
    // $query->bindParam("mn_id", $arr_info["mn_id"]); 
    $query->execute(); 
}

public function getMenu() 
{
    $sql = $this->conn->query("SELECT * FROM tbl_menu mn ORDER BY mn.description ASC"); 
    return $sql; 
}

public function printMenu($usr_id, $hdlang) 
{


    $sql = $this->conn->prepare("
        SELECT mn.* FROM tbl_permission psr 
        INNER JOIN tbl_menu mn ON mn.mn_id=psr.mn_id 
        WHERE psr.usr_id=:usr_id AND psr.can_read=1"); 
    $sql->execute([
        "usr_id" => $usr_id 
    ]); 

    $arr_mn_id = array(); 
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) 
    {
        $mn_id = $row["mn_id"]; 
        $arr_mn_id[] = $mn_id; 

        $menu_desc = $row["description"]; 
        // remove blank space
        $menu_link = str_replace(" ", "", strtolower($menu_desc)); 

        // echo "<li>";
        // echo "<a href=\"/myfactory/". $menu_link ."\">". $menu_desc ."</a>"; 
        // echo "</li>"; 
    }

    if(in_array(1, $arr_mn_id))
    {
        echo "<li>";
        echo "<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"collapse\" aria-expanded=\"false\" data-target=\"#setup\">".$hdlang["setup"]."</a>"; 
        echo "<ul class=\"collapse list-unstyled submenu\" id=\"setup\">";
        echo "<li>"; 
        echo "<a href=\"/myfactory/user/index.php\">Account Maintenance</a>";
        echo "</li>";
        echo "</ul>";
        echo "</li>";
    }

    if(in_array(2, $arr_mn_id))
    {
        echo "<li>";
        echo "<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"collapse\" aria-expanded=\"false\" data-target=\"#misc\">Miscellaneous</a>"; 
            echo "<ul class=\"collapse list-unstyled submenu\" id=\"misc\">";
                echo "<li>"; 
                echo "<a href=\"#\">Cut Lot</a>";
                echo "</li>";

                echo "<li>"; 
                echo "<a href=\"#\">Cut Group</a>";
                echo "</li>";
            echo "</ul>";
        echo "</li>";
    }

    // order page 
    echo "<li>";
    echo "<a href=\"/myfactory/order/order.php\">Order</a>"; 
    // echo "<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"collapse\" aria-expanded=\"false\" data-target=\"#order_menu\">Order</a>"; 
        /*echo "<ul class=\"collapse list-unstyled submenu\" id=\"order_menu\">";
            echo "<li>"; 
            echo "<a href=\"#\">IA Master</a>";
            echo "</li>";

            if(in_array(3, $arr_mn_id))
            {
                echo "<li>";
                echo "<a href=\"/myfactory/plan\">Cut Plan</a>"; 
                echo "</li>";
            }

            if(in_array(4, $arr_mn_id))
            {
                echo "<li>";
                echo "<a href=\"/myfactory/ticket\">Ticket</a>"; 
                echo "</li>";
            }
            
        echo "</ul>";*/
    echo "</li>";
    


}

public function getUserPermissionByMenu($usr_id, $mn_id) 
{
    $sql = $this->conn->prepare("SELECT * FROM tbl_permission pms WHERE pms.usr_id=:usr_id AND pms.mn_id=:mn_id "); 
    $sql->execute([
        "usr_id" => $usr_id, 
        "mn_id" => $mn_id
    ]); 
    return $sql;
}



} // end class

?>