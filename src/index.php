<?php 
	// entrypoint, akan redirect ke /mhs/view.php
	require_once __DIR__ . "/constant.inc";

	header("Location: {$env['server']}/mhs/view.php", true, 302);
	exit();
?>