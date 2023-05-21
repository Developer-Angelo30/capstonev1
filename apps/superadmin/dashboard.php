<?php

    include_once("../includes/sessions/loggedSession.php");
    include_once("../includes/logs/log.php");
    $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department'], new Log);
    $session->loggedSessionSuperAdmin();

    
?>