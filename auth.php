<?php 
session_start();

if(empty($_SESSION['email'])){
echo "<script>window.open('login.php','_self')</script>";  
}
?>
