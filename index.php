<?php
	include 'conn.inc.php';
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>HomePage</title>
		<link href="menu.css" rel="stylesheet" />
		<script type="text/javascript">
			function welcome() {
				alert("Benvenuto !");
			}
		</script>
	</head>
	<body onload="welcome()">
		<body bgcolor = "00BFFF"/>
		<!-- Menu -->
		<nav align = "center">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="registrazione.php">Registrati</a></li>
				<li><a href="#">Area Privata</a>
					<ul>
						<li><a href="log_in.php">Accedi</a></li>
					</ul>
				</li>
			</ul>
		</nav>		
	</body>
</html>