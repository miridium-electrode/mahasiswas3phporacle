<?php
// include $env, config untuk db
require_once __DIR__ . '/constant.inc';

// export $conn
global $conn;
// connect database
$conn = oci_connect($env['dbusername'], $env['dbpassword'], $env['dbconnstring']);
// error handling
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}