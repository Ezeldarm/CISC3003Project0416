<?php
// 开启 session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page or home page
header("location: index.php");
exit;
?>