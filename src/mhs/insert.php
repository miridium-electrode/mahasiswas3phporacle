<?
	require_once __DIR__ . '/../connect.inc';
	require_once __DIR__ . '/../random_str.inc';

	$id = random_str();
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$nrp = $_POST['nrp'];

	$q = oci_parse($conn, "INSERT INTO mahasiswa (id_mahasiswa, nama, kelas, nrp) VALUES
	(:id, :nama, :kelas, :nrp)");

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