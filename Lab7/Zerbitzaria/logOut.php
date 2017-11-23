<!DOCTYPE html>
<html>
	<head>
	</head>
	
	<body>
	
		<h2>Saioa itxi</h2>
	
	</body>
</html>

<?php
session_start();
session_destroy();
echo '	<script type="text/javascript">
			alert("Saioa ongi itxi da. ");
			window.location.href = "layout.php";
		</script>';
?>