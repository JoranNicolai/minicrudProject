<?php
// standaard logout code (start pakt array en destroyed session header naar index)
session_start();
$_SESSION = array();
session_destroy();
header("location: login.php");
exit;
?>