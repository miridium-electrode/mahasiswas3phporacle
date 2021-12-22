<?
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../constant.inc';

	$id = $_GET['id'];

	$q = oci_parse($conn, "DELETE FROM mahasiswa WHERE id_mahasiswa = (:id)");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ':id', $id);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header("Location: {$env['server']}/mhs/view.php", true, 303);
	exit();