<?php
	include 'conn.inc.php';
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Area Privata</title>
		<link href="menu.css" rel="stylesheet" />
	</head>
	<body>	
		<body bgcolor = "00BFFF"/>

		<!-- Menu -->
		<nav align = "center">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Profilo</a>
					<ul>
						<li><a href="log_out.php">Log Out</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- Form -->
		<form>
			<select>
				<?php
					$mysqli = new mysqli("localhost","root","","RegistrazioneUtenti");
					$query = $mysqli->query("SELECT idCategoria,NomeCategoria FROM Categoria");
    			while($row=$query->fetch_row()){                                                 
						echo "<option value='".$row[0]."'>".$row[1]."</option>";
    			}
				?>
			</select>
		</form>
		
	</body>
</html>