<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$conn = new Database();
$language = new Language("EN");
$hdlang =  $language->userLanguage();

echo $hdlang["User_ID"];
?>