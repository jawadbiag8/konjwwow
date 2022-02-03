<?php
if(!isset($_SESSION)){
session_start();
}
unset($_SESSION['support']);
header('location:login.php');
exit();


?>