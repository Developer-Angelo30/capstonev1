<?php

ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

    session_start();
    include_once("../includes/sessions/loggedSession.php");
    include_once("../includes/logs/log.php");
    $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department'], new Log);
    $session->loggedSessionAdmin();

?>