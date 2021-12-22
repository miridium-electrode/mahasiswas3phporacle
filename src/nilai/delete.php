<?php 
	require_once __DIR__ . '/../connect.inc';

	$idMatkul = $_GET['idmatkul'];
	$idNilai = $_GET['idn'];

	$q = oci_parse($conn, "DELETE FROM nilai WHERE id_nilai = :id");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":id", $idNilai);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: http://localhost:8080/nilai/view.php?idmatkul={$idMatkul}", true, 303);
	exit();