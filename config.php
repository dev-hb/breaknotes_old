<?php
session_start();
date_default_timezone_set("Africa/Casablanca");

include 'functions.php';

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "hba7222000");
define("DBNAME", "db_breaknotes");

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);


function logout(){
    // destroy the session and redirect to login pa
    session_unset("breaknotes_id");
    session_destroy();
    unset($_COOKIE['breaknoter']);
    setcookie("breaknoter", null, time()-3600, "/");
    header("location: login.php");
    exit;
}

?>