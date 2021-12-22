<?php
require_once __DIR__ . '/constant.inc';

global $conn;
$conn = oci_connect($env['dbusername'], $env['dbpassword'], $env['dbconnstring']);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}