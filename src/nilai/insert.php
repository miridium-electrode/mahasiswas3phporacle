<?php 
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../random_str.inc';
	require_once __DIR__ . '/../constant.inc';

	$idNilai = random_str();
	$idMatkul = $_POST['idmatkul'];
	$tugas = $_POST['tugas'];
	$nilai = $_POST['nilai'];

	$q = oci_parse($conn, "INSERT INTO nilai(id_nilai, id_matakuliah, tugas, nilai)
	VALUES (:idnilai, :idmatkul, :tugas, :nilai)");
	
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":idnilai", $idNilai);
	oci_bind_by_name($q, ":idmatkul", $idMatkul);
	oci_bind_by_name($q, ":tugas", $tugas);
	oci_bind_by_name($q, ":nilai", $nilai);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: {$env['server']}/nilai/view.php?idmatkul={$idMatkul}", true, 302);
	exit();