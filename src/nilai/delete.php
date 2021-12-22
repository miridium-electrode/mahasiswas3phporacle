<?php 
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../constant.inc';

	// url query parameter
	// idn untuk id_nilai
	$idMatkul = $_GET['idmatkul'];
	$idNilai = $_GET['idn'];

	// delete dengan filter id_nilai
	$q = oci_parse($conn, "DELETE FROM nilai WHERE id_nilai = :id");
	// error handling
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// bind variable
	oci_bind_by_name($q, ":id", $idNilai);

	// execute query
	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// free resource utk delete dan close connection
	oci_free_statement($q);
	oci_close($conn);

	// redirect ke /nilai/view.php
	header("Location: {$env['server']}/nilai/view.php?idmatkul={$idMatkul}", true, 303);
	exit();