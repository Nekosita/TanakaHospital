<?php
session_start(); 


//sessionを空にする
unset($_SESSION['user_id']);
header('Location: ../index.php');
 
exit(); 
?>