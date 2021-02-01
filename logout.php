<?php
include "/includes/config.php";
$page_name="Выход";
include "/includes/database.php";
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['role_id']);
unset($_SESSION['role_name']);
unset($_SESSION['Avatar']);

unset($_COOKIE['id']);
unset($_COOKIE['username']);
unset($_COOKIE['role_id']);
unset($_COOKIE['role_name']);
unset($_COOKIE['Avatar']);
setcookie('id', null, -1, '/');
setcookie('username', null, -1, '/');
setcookie('role_id', null, -1, '/');
setcookie('role_name', null, -1, '/');
setcookie('Avatar', null, -1, '/');

session_unset ();
session_destroy ();
header ("Location: index.php");
exit;

