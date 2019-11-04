<?php 
session_start(); 

unset($_SESSION["usr_id"]); 
session_destroy(); 
header("Location: login.php"); 

?>