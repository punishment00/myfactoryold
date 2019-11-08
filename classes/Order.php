<?php 
class Order
{
private $conn; 

public function setConn($conn) 
{
    $this->conn = $conn;
}

public function getAllOrder()
{
    $res = $this->conn->query("SELECT * FROM tblorder odr"); 
    return $res; 
}


}// end class