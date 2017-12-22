<!DOCTYPE html>
<?php
session_start();
session_destroy();
?>
<html>
	<head>
	</head>
	
	<body>	
	</body>
</html>

<?php
echo '	<script type="text/javascript">
			alert("Saioa ongi itxi da. ");
			window.location.href = "layout.php";
		</script>';
?>