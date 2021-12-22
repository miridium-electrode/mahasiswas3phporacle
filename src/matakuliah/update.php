<?
	require_once __DIR__ . '/../connect.inc';

	$idMhs = $_POST['idmhs'];
	$idMatkul = $_POST['idmatkul'];
	$nama = $_POST['nama'];

	$q = oci_parse($conn, "UPDATE matakuliah SET nama=:nama WHERE id_matakuliah=:id");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":nama", $nama);
	oci_bind_by_name($q, ":id", $idMatkul);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: http://localhost:8080/matakuliah/view.php?idmhs={$idMhs}", true, 303);
	exit();
