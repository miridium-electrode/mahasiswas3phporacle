<?php 
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../constant.inc';

	$idMatkul = $_GET['idmatkul'];
	$idMhs = $_GET['idmhs'];

	$q = oci_parse($conn, "DELETE FROM matakuliah WHERE id_matakuliah = :id");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":id", $idMatkul);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: {$env['server']}/matakuliah/view.php?idmhs={$idMhs}", true, 303);
	exit();