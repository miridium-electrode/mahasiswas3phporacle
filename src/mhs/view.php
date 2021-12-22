<?php
	require_once __DIR__ . '/../connect.inc';

	$q = oci_parse($conn, "SELECT id_mahasiswa, nama, kelas, nrp FROM mahasiswa");
	if (!$q) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($q);
	if (!$r) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title>View Mahasiswa</title>
</head>
<style>
	a {
		cursor: pointer;
		text-decoration: none;
	}

	a:link {
		color: black;
	}

	a:visited {
		color: black;
	}

	a:hover {
		color: lightskyblue;
	}

	.create-btn {
		color: white;
	}
</style>
<body>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">name</th>
				<th scope="col">kelas</th>
				<th scope="col">nrp</th>
				<th scope="col">#</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row = oci_fetch_assoc($q)) {
				echo '<tr>';
				echo "
					<td>
						<a href=\"http://localhost:8080/matakuliah/view.php?idmhs={$row['ID_MAHASISWA']}\">
							{$row['NAMA']}
						</a>
					</td>
				";
				echo "<td>{$row['KELAS']}</td>";
				echo "<td>{$row['NRP']}</td>";
				echo "
				<td>
					<a href=\"http://localhost:8080/mhs/updateview.php?id={$row['ID_MAHASISWA']}\">
						<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">
							<path d=\"M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z\"/>
							<path fill-rule=\"evenodd\" d=\"M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z\"/>
						</svg>
					</a>
					<a href=\"http://localhost:8080/mhs/delete.php?id={$row['ID_MAHASISWA']}\">
						<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash\" viewBox=\"0 0 16 16\">
							<path d=\"M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z\"/>
							<path fill-rule=\"evenodd\" d=\"M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z\"/>
						</svg>
					</a>
				</td>
				";
				echo '</tr>';
			}?>
		</tbody>
	</table>
	<a href="http://localhost:8080/mhs/insertview.php" class="btn btn-primary">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus create-btn" viewBox="0 0 16 16">
			<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
		</svg>
		<span class="create-btn">Create Mahasiswa</span> 
	</a>
</body>
</html>

<?php
	oci_free_statement($q);
	oci_close($conn);
?>