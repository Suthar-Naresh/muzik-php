<?php

session_start();

/*
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), time() - 42000, $params["path"], $parms["domain"], $params["secure"], $params["httponly"]);
}
*/
setcookie(session_name(),"",100);
session_unset();
session_destroy();
$_SESSION = array();

header("location: ./login.php");
exit();