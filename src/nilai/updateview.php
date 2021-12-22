<?php 
	require_once __DIR__ . "/../connect.inc";

	$idMatkul = $_GET['idmatkul'];
	$idNilai = $_GET['idn'];

	$q = oci_parse($conn, "SELECT tugas, nilai FROM nilai WHERE id_nilai = :id");
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

	$row = oci_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Nilai</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		.centering {
			width: 100vw;
			height: 100vh;
			display: grid;
			place-items: center;
		}
	</style>
</head>
<body>
	<div class="centering">
		<form action="update.php" method="post" class="container">
			<h2 class="mb-3">Update Nilai</h2>
			<div class="row mb-3">
				<label for="tugas" class="col form-label me-3">Nama Tugas</label>
				<input type="text" name="tugas" class="col form-control" value="<?= $row['TUGAS']?>"/>
			</div>
			<div class="row mb-3">
				<label for="nilai" class="col form-label me-3">Nilai</label>
				<input type="text" name="nilai" class="col form-control" value="<?= $row['NILAI']?>"/>
			</div>
			<input type="hidden" name="idn" value="<?= $idNilai?>"/>
			<input type="hidden" name="idmatkul" value="<?= $idMatkul?>">
			<div class="row">
				<button type="submit" class="btn btn-primary col me-3">Update Nilai</button>
				<button type="reset" class="btn btn-danger col">Reset</button>
			</div>
		</form>
	</div>
</body>
</html>

<?php
	oci_free_statement($q);
	oci_close($conn);
?>