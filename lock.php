<?php 
session_start(); 

if(!isset($_SESSION["usr_id"]))
{
    header("Location: login.php"); 
    die;
}


spl_autoload_register(function ($class) {
    include "classes/" . $class . ".php";
});

$db = new Database();
$usr_language = $_SESSION["usr_language"]; 
switch ($usr_language) {  
    case 2: $usr_language = "ZH"; break;
    case 1: 
    default: $usr_language = "EN"; break;
}
$language = new Language($usr_language);
$hdlang =  $language->userLanguage();

$user_class = new User(); 
$user_class->setConn($db->conn); 


$acctid = $_SESSION["usr_id"]; 
$today_date = date("Y-m-d"); 

?>