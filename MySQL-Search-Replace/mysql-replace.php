<?php
// show errors (.ini file dependant) - true/false
$showErrors = true;

if ($showErrors) {
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}

// SEARCH FOR
$search = $_POST['searchFor'];
// REPLACE WITH
$replace = $_POST['replaceWith'];
// DB Details
$hostname = $_POST['hostname'];
$database = $_POST['database'];
$username = $_POST['username'];
$password = $_POST['password'];
// Query Type: 'search' or 'replace'
$queryType = $_POST['queryType'];

// add class file
require_once 'Class.MySQLSearchReplace.php';
// settings
$config = array
(
    'server'   => $hostname,
    'user'     => $username,
    'password' => $password,
    'db'       => $database,
    'action'   => $queryType,
);
// do now..
$tool = (new MySQLSearchReplace($config, $search, $replace))->startFindReplace();
