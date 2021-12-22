<?php 
	require_once __DIR__ . "/../connect.inc";

	$idMhs = $_GET['idmhs'];
	$idMatkul = $_GET['idmatkul'];

	$q = oci_parse($conn, "SELECT nama FROM matakuliah WHERE id_matakuliah = :id");
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

	$row = oci_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update View Matakuliah</title>
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
			<a href="<?= "{$env['server']}/matakuliah/view.php?idmhs={$idMhs}" ?>" class="btn btn-primary">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
				</svg>
				 Back to Matakuliah
			</a>
			<h2 class="mb-3">Update Matakuliah</h2>
			<div class="row mb-3">
				<label for="nama" class="col form-label me-3">Nama Matakuliah</label>
				<input type="text" name="nama" class="col form-control" value="<?= $row['NAMA']?>"/>
			</div>
			<input type="hidden" name="idmhs" value="<?= $idMhs?>"/>
			<input type="hidden" name="idmatkul" value="<?= $idMatkul?>">
			<div class="row">
				<button type="submit" class="btn btn-primary col me-3">Update Mata Kuliah</button>
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