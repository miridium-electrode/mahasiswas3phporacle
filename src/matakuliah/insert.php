<?php 
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../random_str.inc';

	$idMatkul = random_str();
	$idMhs = $_POST['idmhs'];
	$nama = $_POST['nama'];

	$q = oci_parse($conn, "INSERT INTO matakuliah(id_matakuliah, id_mahasiswa, nama)
	VALUES (:idmatkul, :idmhs, :nama)");

	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	oci_bind_by_name($q, ":idmatkul", $idMatkul);
	oci_bind_by_name($q, ":idmhs", $idMhs);
	oci_bind_by_name($q, ":nama", $nama);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: http://localhost:8080/matakuliah/view.php?idmhs={$idMhs}", true, 302);
	exit();