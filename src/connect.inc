<?php

global $conn;
$conn = oci_connect('mhs', 'mypass', 'oracledb/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}