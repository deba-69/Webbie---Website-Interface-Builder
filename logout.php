<?php
@session_start();
session_unset();
session_destroy();
setcookie("username");
setcookie("email");
echo "<script>window.open('home_pg.php','_self')</script>";
?>