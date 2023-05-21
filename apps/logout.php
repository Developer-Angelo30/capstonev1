<?php
session_start();
include_once("./includes/logs/log.php");
$log = new Log;
session_destroy();
$log->saveLog("../logs.log", "logout.");
header("location: index.php");
?>