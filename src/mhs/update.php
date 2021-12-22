<?
	require_once __DIR__ . '/../connect.inc';

	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$nrp = $_POST['nrp'];

	$q = oci_parse($conn, "UPDATE mahasiswa SET nama=:nama, kelas=:kelas,
	nrp=:nrp WHERE id_mahasiswa = :id");

	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_bind_by_name($q, ":id", $id);
	oci_bind_by_name($q, ":nama", $nama);
	oci_bind_by_name($q, ":kelas", $kelas);
	oci_bind_by_name($q, ":nrp", $nrp);

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($q);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	oci_free_statement($q);
	oci_close($conn);

	header('Location: http://localhost:8080/mhs/view.php', true, 302);
	exit();