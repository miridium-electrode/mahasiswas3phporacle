<?php
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../constant.inc';

	$idNilai = $_POST['idn'];
	$idMatkul = $_POST['idmatkul'];
	$tugas = $_POST['tugas'];
	$nilai = $_POST['nilai'];

	$q = oci_parse($conn, "UPDATE nilai SET tugas=:tugas, nilai=:nilai, 
	id_matakuliah=:idm WHERE id_nilai=:idn");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":tugas", $tugas);
	oci_bind_by_name($q, ":nilai", $nilai);
	oci_bind_by_name($q, ":idm", $idMatkul);
	oci_bind_by_name($q, ":idn", $idNilai);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: {$env['server']}/nilai/view.php?idmatkul={$idMatkul}", true, 303);
	exit();
