<?php 
class User
{
	private $conn; 

	
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

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
			if(password_verify($input_password, $fetch_password)) 
			{
				$_SESSION["usr_id"] = $usr_id; 
                $_SESSION["usr_language"] = $language; 
                $_SESSION["username"] = $username; 
				$_SESSION["login_error"] = 0;  

                header("Location: index.php"); 
			}
			else
			{
				$_SESSION["login_error"] = 1;
                header("Location: login.php"); 
			}
		}
		else
		{
			$_SESSION["login_error"] = 1;
            header("Location: login.php"); 
		}

	}

    public function printMisc() 
    {
        $usr_id = $_SESSION["usr_id"]; 

        $sql = $this->conn->prepare("
            SELECT mn.* FROM tbl_permission psr 
            INNER JOIN tbl_menu mn ON mn.mn_id=psr.mn_id 
            WHERE psr.usr_id=:usr_id AND psr.can_read=1 AND mn.mn_id IN (1,2,3)"); 
        $sql->execute([
            "usr_id" => $usr_id 
        ]); 

        while($row = $sql->fetch(PDO::FETCH_ASSOC)) 
        {
            $menu_desc = $row["description"]; 
            // remove blank space
            $menu_link = str_replace(" ", "", strtolower($menu_desc)); 

            echo "<li>";
            echo "<a href=\"/myfactory/". $menu_link ."\">". $menu_desc ."</a>"; 
            echo "</li>"; 
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


} // end class

?>